<template>
    <div class="footer-container">
        <img class="round-image" src="../../../public/images/logo/bottom.jpg"/>

        <div class="footer-content">        
            <div>Контакты:</div>
            <div>номер телефона</div>
            <div>номер телефона</div>
            <div class="address-info">
                <div>Minsk, Prytyyskaga street 36, 11</div>
            </div>
            <div class="social-icons">
                <img class="social-icon" src="../../../public/images/logo/ig.png">
                <img class="social-icon" src="../../../public/images/logo/youtube.png">
            </div>
        </div>
    </div>
  </template>
  
  <style scoped>
  .footer-container {
  display: flex;
  background-color: #333;
  color: #fff;
  padding: 20px;
}

.round-image {
  width: calc(100% / 3); /* Ширина в 1/3 от ширины футера */
  height: 100%;
  border-radius: 50%;
}

.address-info {
  flex: 1;
  padding: 0 4px;
}
.social-icons {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    flex: 1;
    padding: 0 4px;
}

.social-icon {
    width: 24px; /* Задайте требуемую ширину для иконок */
    height: 24px; /* Задайте требуемую высоту для иконок */
    margin-right: 8px; /* Отступ между иконками */
}

.contact-info,
.address-info {
  text-align: left;
}

.social-icons {
  display: flex;
  align-items: center;
  justify-content: flex-end;
}
  .footer-container {
    background-color: #333; /* Цвет фона футера */
    color: #fff; /* Цвет текста футера */
    padding: 20px; /* Отступы внутри футера */
    text-align: center;
    align-items: flex-end;
  }
  
  .contact-info {
    margin-bottom: 10px;
  }
  
  .round-image {
    background-color: #fff; /* Цвет фона круглой картинки */
    margin-right: 20px; /* Отступ справа от круглой картинки */
  }
  
  .address-info {
    text-align: left; /* Выравнивание текста влево */
  }
  </style>
  