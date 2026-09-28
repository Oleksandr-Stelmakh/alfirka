<template>

    <section
        class="mx-auto mt-16 max-w-3xl rounded-3xl border border-violet-200 bg-white/90 p-6 shadow-xl backdrop-blur-sm 
            dark:border-violet-700 dark:bg-violet-950/80 sm:p-8"
    >

        <!-- Заголовок -->
        <div class="text-center">

            <span
                class="text-sm font-semibold uppercase tracking-[0.2em] text-pink-500"
            >
                🌸 Замовлення
            </span>

            <h2
                class="mt-3 text-3xl font-bold text-violet-900 dark:text-white"
            >
                Замовити букет
            </h2>

            <p
                class="mx-auto mt-3 max-w-xl text-violet-600 dark:text-violet-300"
            >
                Заповніть форму, і ми зв'яжемося з вами для уточнення деталей замовлення
            </p>

        </div>


        <!-- Информация о выбранном букете -->

        <div
            class="mt-8 rounded-2xl bg-violet-50 p-5 dark:bg-violet-900/50"
        >

            <div
                class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between"
            >

                <div>

                    <p
                        class="text-sm sm:text-center text-violet-500 dark:text-violet-300"
                    >
                        Обраний букет
                    </p>

                    <p
                        class="mt-1 text-lg font-semibold text-violet-900 dark:text-white"
                    >
                        {{ bouquet.title }}
                    </p>

                </div>


                <div class="sm:text-right">

                    <p
                        class="text-sm text-violet-500 dark:text-violet-300"
                    >
                        Розмір
                    </p>

                    <p
                        class="mt-1 font-semibold sm:text-center text-violet-900 dark:text-white"
                    >
                        {{ selectedSize.name }}
                    </p>

                </div>


                <div class="sm:text-center">

                    <p
                        class="text-sm text-violet-500 dark:text-violet-300"
                    >
                        Ціна
                    </p>

                    <p
                        class="mt-1 text-xl font-bold text-pink-600"
                    >
                        {{ selectedSize.price }} грн
                    </p>

                </div>

            </div>

        </div>


        <!-- Форма -->
        <form
            class="mt-8 space-y-5"
            @submit.prevent="submitForm"
        >

        <!-- Успешная отправка -->
        <div
            v-if="successMessage"
            class="relative mb-6 rounded-2xl border border-emerald-500/60 bg-emerald-500/15 px-5 py-4 pr-12 text-center 
               text-emerald-700 shadow-lg backdrop-blur dark:border-emerald-400/60 dark:bg-emerald-500/20 
               dark:text-emerald-400"
        >
              <span class="font-medium">
                 {{ successMessage }}
              </span>

              <button
                 type="button"
                 class="absolute right-1 top-0.5 flex h-6 w-8 items-center justify-center rounded-md text-emerald-700 transition 
                     hover:bg-emerald-500/10 dark:text-emerald-500"
                 aria-label="Закрити повідомлення"
                 @click="successMessage = ''"
              >
                  <X
                     class="h-4 w-4"
                     :stroke-width="2"
                  />
              </button>
        </div>

            <!-- Имя -->

            <div>

                <label
                    for="order-name"
                    class="block text-sm font-medium text-violet-800 dark:text-violet-200"
                >
                    Ваше ім'я
                </label>

                <input
                    id="order-name"
                    v-model="form.name"
                    type="text"
                    autocomplete="name"
                    placeholder="Наприклад, Олександр"
                    class="mt-2 w-full rounded-xl border bg-white px-4 py-3 text-violet-900 outline-none transition 
                      placeholder:text-violet-300 dark:bg-violet-900 dark:text-white dark:placeholder:text-violet-500"
                    :class="errors.name
                        ? 'border-red-500 focus:border-red-500 focus:ring-2 focus:ring-red-200 dark:border-red-500 dark:focus:ring-red-900'
                        : 'border-violet-200 focus:border-violet-500 focus:ring-2 focus:ring-purple-200 dark:border-violet-700 dark:focus:ring-violet-800'"
                    @input="clearError('name')"
                />

                <p
                    v-if="errors.name"
                    class="mt-1 text-sm text-red-500"
                >
                    {{ errors.name }}
                </p>

            </div>


            <!-- Телефон -->

            <div>

                <label
                    for="order-phone"
                    class="block text-sm font-medium text-violet-800 dark:text-violet-200"
                >
                    Номер телефону
                </label>

                <input
                    id="order-phone"
                    v-model="form.phone"
                    type="tel"
                    autocomplete="tel"
                    placeholder="+380..."
                    class="mt-2 w-full rounded-xl border bg-white px-4 py-3 text-violet-900 outline-none transition 
                      placeholder:text-violet-300 dark:bg-violet-900 dark:text-white dark:placeholder:text-violet-500"
                    :class="errors.phone
                       ? 'border-red-500 focus:border-red-500 focus:ring-2 focus:ring-red-200 dark:border-red-500 dark:focus:ring-red-900'
                       : 'border-violet-200 focus:border-violet-500 focus:ring-2 focus:ring-purple-200 dark:border-violet-700 dark:focus:ring-violet-800'"
                    @input="clearError('phone')"
                />

                <p
                    v-if="errors.phone"
                    class="mt-1 text-sm text-red-500"
                >
                    {{ errors.phone }}
                </p>

            </div>


            <!-- Email -->

            <div>

                <label
                    for="order-email"
                    class="block text-sm font-medium text-violet-800 dark:text-violet-200"
                >
                    Email
                </label>

                <input
                    id="order-email"
                    v-model="form.email"
                    type="email"
                    autocomplete="email"
                    placeholder="example@gmail.com"
                    class="mt-2 w-full rounded-xl border bg-white px-4 py-3 text-violet-900 outline-none transition 
                      placeholder:text-violet-300 dark:bg-violet-900 dark:text-white dark:placeholder:text-violet-500"
                    :class="errors.email
                        ? 'border-red-500 focus:border-red-500 focus:ring-2 focus:ring-red-200 dark:border-red-500 dark:focus:ring-red-900'
                        : 'border-violet-200 focus:border-violet-500 focus:ring-2 focus:ring-purple-200 dark:border-violet-700 dark:focus:ring-violet-800'"
                    @input="clearError('email')"
                />

                <p
                    v-if="errors.email"
                    class="mt-1 text-sm text-red-500"
                >
                    {{ errors.email }}
                </p>

            </div>


            <!-- Комментарий -->

            <div>

                <label
                    for="order-comment"
                    class="block text-sm font-medium text-violet-800 dark:text-violet-200"
                >
                    Коментар
                    <span class="font-normal text-violet-400">
                        (необов'язково)
                    </span>
                </label>

                <textarea
                    id="order-comment"
                    v-model="form.comment"
                    rows="4"
                    placeholder="Наприклад, бажана дата отримання..."
                    class="mt-2 w-full resize-none rounded-xl border border-violet-200 bg-white px-4 py-3 text-violet-900 
                     outline-none transition placeholder:text-violet-300 focus:border-violet-500 focus:ring-2 focus:ring-purple-200 
                     dark:border-violet-700 dark:bg-violet-900 dark:text-white dark:placeholder:text-violet-500 
                     dark:focus:ring-violet-800"
                ></textarea>

            </div>


            <!-- Кнопки -->

            <div class="flex flex-col gap-3 pt-2 sm:flex-row">

                <Button
                   type="submit"
                   size="lg"
                   class="w-full"
                   :disabled="isSubmitting"
               >
                   <span class="flex items-center justify-center gap-2">

                       <!-- Спиннер -->
                       <span
                           v-if="isSubmitting"
                           class="h-5 w-5 animate-spin rounded-full border-2 border-white/30 border-t-white"
                           aria-hidden="true"
                       ></span>

                       <!-- Текст -->
                       <span>
                           {{ isSubmitting ? 'Надсилаємо...' : 'Надіслати замовлення' }}
                       </span>

                   </span>
               </Button>

                <Button
                    type="button"
                    variant="secondary"
                    size="lg"
                    class="w-full"
                    @click="$emit('close')"
                >
                    Скасувати
                </Button>

            </div>

        </form>

    </section>

</template>


<script setup>

import { router } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'
import { X } from 'lucide-vue-next'
import Button from '@/Components/UI/Button.vue'


const props = defineProps({

    bouquet: {
        type: Object,
        required: true,
    },

    selectedSize: {
        type: Object,
        required: true,
    },

})


defineEmits([
    'close',
])


const isSubmitting = ref(false)

const successMessage = ref('')


const form = reactive({

    name: '',
    phone: '',
    email: '',
    comment: '',

})


const errors = reactive({

    name: '',
    phone: '',
    email: '',

})

function clearError(field) {

    errors[field] = ''

}

function validateForm() {

    errors.name = ''
    errors.phone = ''
    errors.email = ''


    // Имя

    if (!form.name.trim()) {

        errors.name = "Вкажіть, будь ласка, ваше ім'я"

    } else if (form.name.trim().length < 2) {

        errors.name = "Ім'я повинно містити щонайменше 2 символи"

    }


    // Телефон

    const phoneDigits = form.phone.replace(/\D/g, '')

    if (!form.phone.trim()) {

        errors.phone = 'Вкажіть номер телефону'

    } else if (phoneDigits.length < 12) {

        errors.phone = 'Введіть повний номер телефону'

    }


    // Email

    const emailPattern =
        /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/


    if (!form.email.trim()) {

        errors.email = 'Вкажіть Email'

    } else if (!emailPattern.test(form.email.trim())) {

        errors.email = 'Введіть коректний Email'

    }


    return !errors.name && !errors.phone && !errors.email

}

function submitForm() {

    if (!validateForm()) {
        return
    }

    successMessage.value = ''

    router.post(

        route('orders.store'),

        {
            name: form.name,
            phone: form.phone,
            email: form.email,
            comment: form.comment,
            product_variant_id: props.selectedSize.id,
        },

        {

            preserveScroll: true,

            onStart: () => {

                isSubmitting.value = true

            },

            onFinish: () => {

                isSubmitting.value = false

            },

            onSuccess: () => {

                successMessage.value =
                    'Ваше замовлення успішно відправлено! Ми зв’яжемося з вами найближчим часом'

                form.name = ''
                form.phone = ''
                form.email = ''
                form.comment = ''

                errors.name = ''
                errors.phone = ''
                errors.email = ''

            },

            onError: (serverErrors) => {

                console.log(
                    'SERVER VALIDATION ERRORS:',
                    serverErrors
                )

                errors.name =
                    serverErrors.name || ''

                errors.phone =
                    serverErrors.phone || ''

                errors.email =
                    serverErrors.email || ''

            },

        }

    )

}

</script>