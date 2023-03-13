<template>
    <div>
        <h2 class="sr-only">Checkout</h2>

        <form
            class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16"
            @submit.prevent="onSubmit"
            v-if="!orderSent"
        >
            <div>
                <div>
                    <h2 class="text-lg font-medium text-gray-900">
                        Contact information
                    </h2>
                    <div class="mt-4">
                        <label for="email-address" class="block text-sm font-medium text-gray-700">
                            Email address *
                        </label>
                        <div class="mt-1">
                            <input
                                type="email"
                                id="email-address"
                                name="email-address"
                                :disabled="loading"
                                autocomplete="email"
                                v-model="email"
                                required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            >
                        </div>
                    </div>
                </div>

                <div class="mt-10 border-t border-gray-200 pt-10">
                    <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>

                    <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                        <div>
                            <label for="first-name" class="block text-sm font-medium text-gray-700">
                                First name *
                            </label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    id="first-name"
                                    name="first-name"
                                    required
                                    :disabled="loading"
                                    autocomplete="given-name"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    v-model="firstname"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="last-name" class="block text-sm font-medium text-gray-700">Last name  *</label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    id="last-name"
                                    name="last-name"
                                    autocomplete="family-name"
                                    required
                                    :disabled="loading"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    v-model="lastname"
                                >
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address  *</label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    name="address"
                                    id="address"
                                    required
                                    :disabled="loading"
                                    autocomplete="street-address"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    v-model="address"
                                >
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="apartment" class="block text-sm font-medium text-gray-700">Apartment, suite, etc.</label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    name="apartment"
                                    id="apartment"
                                    :disabled="loading"                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    v-model="apartment"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">City  *</label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    name="city"
                                    id="city"
                                    required
                                    :disabled="loading"
                                    autocomplete="address-level2"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    v-model="city"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700">Country  *</label>
                            <div class="mt-1">
                                <select
                                    id="country"
                                    name="country"
                                    required
                                    :disabled="countryOptions === [] || loading"
                                    autocomplete="country-name"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    v-model="country"
                                >
                                    <option :value="country.cca2" v-for="country in countryOptions" :key="country.cca2">
                                        {{ country.flag }} {{ country.name.official }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700">
                                State / Province *</label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    name="region"
                                    id="region"
                                    required
                                    :disabled="loading"
                                    autocomplete="address-level1"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    v-model="state"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="postal-code" class="block text-sm font-medium text-gray-700">
                                Postal code *
                            </label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    name="postal-code"
                                    id="postal-code"
                                    required
                                    autocomplete="postal-code"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    v-model="postal"
                                >
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone *</label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    autocomplete="tel"
                                    required
                                    :disabled="loading"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    v-model="phone"
                                >
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <p class="text-sm">
                            Fields marked with * are required
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order summary -->
            <div class="mt-10 lg:mt-0">
                <h2 class="text-lg font-medium text-gray-900">Order summary</h2>

                <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
                    <h3 class="sr-only">Items in your cart</h3>
                    <ul role="list" class="divide-y divide-gray-200">
                        <li class="flex py-6 px-4 sm:px-6" v-for="product in order" :key="product.ID">
                            <div class="flex-shrink-0">
                                <img
                                    :src="product.product.Image"
                                    :alt="product.product.Name + ' in ' + product.product.Color"
                                    class="w-20 rounded-md"
                                >
                            </div>

                            <div class="ml-6 flex flex-1 flex-col">
                                <div class="flex">
                                    <div class="min-w-0 flex-1">
                                        <h4 class="text-sm">
                                            <a href="#" class="font-medium text-gray-700 hover:text-gray-800">
                                                {{ product.product.Name }}</a>
                                        </h4>
                                        <p class="mt-1 text-sm text-gray-500">{{ product.product.Color }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-1 items-end justify-between pt-2">
                                    <p class="mt-1 text-sm font-medium text-gray-900">${{
                                            formatNumber(product.product.Price)}}</p>

                                    <div class="ml-4">
                                        <label for="quantity" class="sr-only">Quantity</label>
                                        <select
                                            id="quantity"
                                            name="quantity"
                                            class="rounded-md border border-gray-300 text-left text-base font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                                            v-model="product.quantity"
                                        >
                                            <option :value="0">0</option>
                                            <option :value="1">1</option>
                                            <option :value="2">2</option>
                                            <option :value="3">3</option>
                                            <option :value="4">4</option>
                                            <option :value="5">5</option>
                                            <option :value="6">6</option>
                                            <option :value="7">7</option>
                                            <option :value="8">8</option>
                                            <option :value="9">9</option>
                                            <option :value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <dl class="space-y-6 border-t border-gray-200 py-6 px-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">${{ formatNumber(subtotal)}}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-sm">Shipping</dt>
                            <dd class="text-sm font-medium text-gray-900">${{ formatNumber(shipping)
                                }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                            <dt class="text-base font-medium">Total</dt>
                            <dd class="text-base font-medium text-gray-900">${{ formatNumber(total) }}</dd>
                        </div>
                    </dl>

                    <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                        <button
                            type="submit"
                            @submit="onSubmit"
                            :disabled="loading"
                            class="w-full rounded-md border border-transparent bg-indigo-600 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                        >Submit order</button>
                    </div>
                </div>
            </div>
        </form>
        <div v-if="orderSent">
            <p v-if="!orderStatus">
                {{ orderResponse}}
            </p>
            <p v-if="orderStatus">
                Order with id {{ orderResponse.ID }} for ${{orderResponse.Total}} has been received.
            </p>
            <p class="py-4">
                <button
                    @click.prevent="reloadPage"
                    class="w-full rounded-md border border-transparent bg-indigo-500 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                >
                    Click here to place a new order
                </button>
            </p>
        </div>
    </div>
</template>

<script lang="js">
import axios from "axios";
const _ = require('lodash');
export default {
    name: 'Checkout',
    data() {
        return {
            firstname: '',
            lastname: '',
            address: '',
            email: '',
            phone: '',
            apartment: '',
            city: '',
            country: '',
            state: '',
            postal: '',
            order: {},
            countryOptions: [],
            productOptions: [],
            shipping: 5,
            orderStatus: false,
            orderSent: false,
            orderResponse: '',
            loading: false,
        }
    },
    methods: {
        onSubmit() {
            if (!this.loading) {
                this.loading =true
                axios.post('/order', {
                    email: this.email,
                    firstName: this.firstname,
                    lastName: this.lastname,
                    address: this.address,
                    apartment: this.apartment,
                    phone: this.phone,
                    city: this.city,
                    country: this.country,
                    state: this.state,
                    order: this.order,
                    postal: this.postal,
                })
                    .then((response) => {
                        this.orderSent = true
                        this.orderStatus = (response.status === 200)
                        this.orderResponse = response.data
                        this.loading = false
                    })
            }

        },
        reloadPage () {
            window.location.reload()
        },
        formatNumber: function (value) {
            let val = (value / 1).toFixed(2).replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    },
    async mounted() {
        axios.get('/countries').then((response) =>  this.countryOptions = response.data)
        axios.get('/products')
            .then((response) =>  this.productOptions = response.data)
            .then(
                (data) => {
                    data.forEach(
                        product => {
                            this.order[product.ID] = {'product': product, 'quantity': 0}
                        })
                }
            )
    },
    computed: {
        subtotal() {
            let value = 0;
            _.map(
                this.order,
                (order) => {
                    value += order.quantity * order.product.Price
                }
            )

            return value
        },
        total() {
            if (this.subtotal !== 0) {
                return this.subtotal + 5
            }
            return 0
        }
    }
}
</script>
