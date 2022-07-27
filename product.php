<?php include 'layout/header.php'; ?>
   
                <section class="product__section">
                    <div class="product__block">
                        <img src="images/1.jpeg" alt="" class="product__img">
                        <div class="product__title">
                            <h2 class="product__name">Стол компьютерный</h2>
                            <span class="product__date">3 мая 16:20</span>
                        </div>
                        <div class="product__decription">
                            <span class="product__span">описание</span>
                            <span class="product__text">Новый стол раздвижной Арчи
                                Расцветка: акварель, сосна и др
                                Габариты: 1000-1300/1000
                                Материал МДФ 22 мм, стекло 4 мм</span>
                        </div>
                        <div class="product__location">
                            <span class="product__span">расположение</span>
                            <span class="product__text">Краснодар, ул. Цезаря Куникова, 35</span>
                        </div>
                    </div>
                    <div class="contact__block">
                        <h2 class="product__price">1000 ₽</h2>
                        <button class="show__number">показать телефон</button>
                        <button class="send__message">написать сообщение</button>
                        <a href="#" class="salesmam__block">
                            <img src="images/salesman.png" alt="" class="salesman__img">
                            <h3 class="salesman__name">Александр Столд</h3>
                            <span class="salesman__date">на surf с
                                <br> <?php echo date('d.m.Y'); ?> </span>
                            <span class="salesman__review">нет отзывов</span>
                        </a>
                    </div>
                </section>
            </article>
        </div>
   
<?php include 'layout/footer.php'; ?>