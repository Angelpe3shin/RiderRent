<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { currencySymbols } from '../currencySymbols.js';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    basketItems: {
        type: Array
    },
});

const calculateTotalPrice = () => {
  let totalPrice = 0;

  props.basketItems.forEach(item => {
    if (item.status === 'pendingTransaction') {
        const startDate = new Date(item.start_date);
        const endDate = new Date(item.end_date);
        const rentalDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));

        const itemTotalPrice = item.moto.base_rent_price * rentalDays;

        totalPrice += itemTotalPrice;
    }
  });

  return totalPrice;
};

const formatCurrency = (currencyCode) => {
  return currencySymbols[currencyCode] || currencyCode;
};
</script>
<style>
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #626a62;
  color: white;
}
</style>
<template>
    <Head title="Basket" />

    <AuthenticatedLayout :canLogin="$page.props.canLogin" :canRegister="$page.props.canRegister" :isLoggedIn="true">
        <template v-if="$page.props.basketItems && Array.isArray($page.props.basketItems) && $page.props.basketItems.length > 0">
            <div>
                <table>
                <thead>
                    <tr>
                        <th>Moto Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="basket in $page.props.basketItems" :key="basket.id">
                        <td>{{ basket.moto.name }}</td>
                        <td>{{ basket.start_date }}</td>
                        <td>{{ basket.end_date }}</td>
                        <td>
                            <span v-if="basket.status === 'pendingTransaction'" style="color:brown">Pending Transaction</span>
                            <span v-else-if="basket.status === 'paymentFinished'" style="color:darkgreen">Payment Finished</span>
                            <span v-else-if="basket.status === 'removedWithoutFinish'" style="color:dodgerblue">Removed Without Finish</span>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Total:</td>
                        <td>{{ calculateTotalPrice() }} {{ formatCurrency($page.props.basketItems[0].moto.base_rent_currency) }} </td>
                    </tr>
                    <tr>
                        <td>
                            Purchase
                        </td>
                    </tr>
                </tfoot>
                </table>
            </div>
        </template>
        <template v-else>
            <p>No baskets available.</p>
        </template>
    </AuthenticatedLayout>
</template>