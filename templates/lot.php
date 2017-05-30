<main>
    <?= include_templates("templates/nav.php", ['categories' => $categories]) ?>
    <section class="lot-item container">
        <h2> <?php print($lot[2]);?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?php print($lot[4]);?>" width="730" height="548" alt="Сноуборд">
                </div>
                <p class="lot-item__category">Категория: <span> <?=  $categories[$lot[11]-1][1];?></span></p>
                <p class="lot-item__description">Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
                    <?= ($lot[3]);?></p>
            </div>
            <div class="lot-item__right">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="lot-item__state">
                        <div class="lot-item__timer timer">
                            <?php print get_time_remain($lot[6]); ?>
                        </div>
                        <div class="lot-item__cost-state">
                            <div class="lot-item__rate">
                                <span class="lot-item__amount">Текущая цена</span>
                                <span class="lot-item__cost"><?= ($lot[5]);?></span>
                            </div>
                            <div class="lot-item__min-cost">
                                Мин. ставка <span><?= ($lot[5]);?></span>
                            </div>
                        </div>

                        <?php

                        $all_costs = array();

                        foreach (get_my_lots() as $key => $lot_cookie) {
                            foreach ($lot_cookie as $key_cookie => $cookie_item){
                                array_push($all_costs, $key_cookie);
                            }
                        }

                        if (!(in_array ($lot[0] , $all_costs))) {
                        ?>
                        <form class="lot-item__form" action="" method="post">
                            <p class="lot-item__form-item">
                                <label for="cost">Ваша ставка</label>
                                <input id="cost" type="number" name="cost" placeholder="12 000">
                            </p>
                            <button type="submit"  name="add-cost" class="button">Сделать ставку</button>
                        </form>

                        <?php
                        }
                        ?>
                    </div>
                <?php endif; ?>
                <div class="history">
                    <h3>История ставок (<span><?= isset($bets)? count($bets) : "0"; ?></span>)</h3>
                    <table class="history__list">
                        <?php

                        if (isset($bets)) {

                            foreach ($bets as $key => $bet):
                                ?>
                                <tr class="history__item">
                                    <td class="history__name"><?= $users[$bet[3]-1]["name"];?></td>
                                    <td class="history__price"><?= ($bet[2]);?></td>
                                    <td class="history__time"><?= timestamp_to_time(($bet[1]));?></td>
                                </tr>
                                <?php
                            endforeach;
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
