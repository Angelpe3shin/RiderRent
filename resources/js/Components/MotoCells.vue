<template>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="moto-cell" v-for="moto in motos" :key="moto.id">
          <img :src="moto.moto_model.image_url" alt="Moto Image" class="moto-image" />
          <div class="moto-details">
              <h3>{{ moto.name }}</h3>
              <p>{{ moto.moto_model.name }}</p>
              <p>Year: {{ moto.production_year }}</p>
              <p>Price: {{ moto.base_rent_price }}{{ formatCurrency(moto.base_rent_currency) }}</p>
              <form v-if="isLoggedIn" @submit.prevent="handleFormSubmit(moto)">
                <PrimaryButton>{{ getButtonText(moto) }}</PrimaryButton>
              </form>
          </div>
        </div>
    </div>
</template>
  
<script>
  import { currencySymbols } from '../currencySymbols.js';
  import PrimaryButton from '@/Components/PrimaryButton.vue';

  export default {
    props: {
        motos: {
            type: Array,
            required: true,
        },
        basketItems: {
            type: Array,
            required: true,
        },
        isLoggedIn: {
            type: Boolean,
            required: true,
        },
    },
    methods: {
      formatCurrency(currencyCode) {
          return currencySymbols[currencyCode] || currencyCode;
      },
      isMotoAvailable(moto) {
          return moto.status === 'free';
      },
      isMotoInBasket(moto) {
          return this.basketItems.some(item => item.moto_id === moto.id && item.status === 'pendingTransaction');
      },
      async addToBasket(moto) {
        console.log('Starting addToBasket');
        try {
            const response = await this.$inertia.post(route('add-to-basket', { moto: moto }), {
                onFinish: () => console.log('Full Response:', response)
            });
            console.log('Full Response:', response);
        } catch (error) {
            // Обработка ошибок
            console.error('Ошибка при выполнении POST-запроса:', error);
        }
        console.log('Ending addToBasket');
        //   try {
        //     const response = await this.$inertia.post(route('add-to-basket', { moto: moto }));
        //     console.log('Full Response:', response);

        //     if (response && response.data) {
        //         console.log('Response data:', response.data);
        //         this.basketItems = response.data.basketItems;

        //         var basketItem = this.basketItems.find(item => item.moto_id === moto.id);
        //         if (basketItem) {
        //             console.log('Basket item:', basketItem);

        //             // Обработка успешного запроса
        //             moto.status = 'occupied';
        //             basketItem.status = 'pendingTransaction';
        //             console.log('New basket item status:', basketItem.status);
        //             console.log('Is moto in basket:', this.isMotoInBasket(moto));
        //         } else {
        //             console.log('No basket item');
        //         }
        //     } else {
        //         console.log('No response data');
        //     }
        // } catch (error) {
        //     // Обработка ошибок
        //     console.error('Ошибка при выполнении POST-запроса:', error);

        //     // Возможно, здесь стоит добавить дополнительные логи или обработку ошибок
        // }
      },
      async removeFromBasket(moto) {
          console.log(moto.id);
          try {
              await this.$inertia.delete(route('remove-from-basket', { moto: moto }));
              // Обработка успешного запроса
              moto.status = 'free';
          }
          catch (error) {
              // Обработка ошибок
              console.error('Ошибка при выполнении DELETE-запроса:', error);
          }
      },
      handleFormSubmit(moto) {
          if (this.isMotoInBasket(moto)) {
              this.removeFromBasket(moto);
          }
          else {
              this.addToBasket(moto);
          }
      },
      getButtonStyle(moto) {
          return this.isMotoInBasket(moto) ? { color: 'brown' } : { color: 'green' };
      },
      getButtonText(moto) {
          return this.isMotoInBasket(moto) ? 'Remove from basket' : 'Add to basket';
      },
    },
    components: { PrimaryButton }
};
</script>
  
  <style scoped>
  .moto-cell {
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
  }
  
  .moto-image {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
  }
  
  .moto-details {
    margin-top: 10px;
  }
  </style>
  