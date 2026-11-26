
import { ref, computed, watch } from "vue";

const STORAGE_KEY = "alfirka-cart";

// Общее состояние корзины для всего приложения.
const items = ref([]);

// Восстанавливаем корзину после загрузки приложения.
if (typeof window !== "undefined") {
    try {
        const savedCart = localStorage.getItem(STORAGE_KEY);

        if (savedCart) {
            const parsedCart = JSON.parse(savedCart);

            if (Array.isArray(parsedCart)) {
                items.value = parsedCart;
            }
        }
    } catch (error) {
        console.error("Не удалось восстановить корзину:", error);
    }
}

// Сохраняем изменения корзины.
watch(
    items,
    (newItems) => {
        if (typeof window !== "undefined") {
            localStorage.setItem(
                STORAGE_KEY,
                JSON.stringify(newItems)
            );
        }
    },
    { deep: true }
);

// Общее количество единиц товара.
const totalItems = computed(() =>
    items.value.reduce(
        (sum, item) => sum + item.quantity,
        0
    )
);

// Общая стоимость заказа.
// Используется только для отображения в корзине.
// Окончательную стоимость всегда рассчитывает сервер.
const totalPrice = computed(() =>
    items.value.reduce(
        (sum, item) => sum + item.price * item.quantity,
        0
    )
);

// Проверяем, что у каждой позиции есть ID выбранной фотографии.
const hasInvalidItems = computed(() =>
    items.value.some(
        (item) => !item.variantId || !item.imageId
    )
);

function addItem(item) {
    // Одинаковый вариант с одинаковой фотографией
    // объединяем в одну позицию.
    const key = `${item.variantId}:${item.imageId}`;

    const existingItem = items.value.find(
        (existing) => existing.key === key
    );

    if (existingItem) {
        existingItem.quantity += 1;
        return;
    }

    items.value.push({
        ...item,
        key,
        quantity: 1,
    });
}

function removeItem(key) {
    items.value = items.value.filter(
        (item) => item.key !== key
    );
}

function updateQuantity(key, quantity) {
    const item = items.value.find(
        (item) => item.key === key
    );

    if (!item) return;

    const newQuantity = Math.max(
        1,
        Math.min(99, Math.floor(Number(quantity) || 1))
    );

    item.quantity = newQuantity;
}

function clearCart() {
    items.value = [];
}

export function useCart() {
    return {
        items,
        totalItems,
        totalPrice,
        hasInvalidItems,
        addItem,
        removeItem,
        updateQuantity,
        clearCart,
    };
}
