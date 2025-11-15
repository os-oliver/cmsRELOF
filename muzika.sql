SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET COLLATION_CONNECTION = utf8mb4_unicode_ci;

INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2013.) Сукоб Интереса - Са Ове Стране Дуге (онлајн издање)');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2013.) Сукоб Интереса - Са Ове Стране Дуге (онлајн издање)');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Истоимена Песма
02. Бендови Из Главног Града
03. Браво
04. Лаж
05. Хоćу Да Пушим
06. Праслин
07. Стиже Беба
08. У Тераријуму
09. Као Бане (Не Тако Добри Син)
10. Шутнут
11. Сепса Је Управо Напустила Зграду
12. Лош Дан 4
13. Терање
14. Зуб Плагијатор
15. Опроштајна Песма
16. Самоубиство
17. Одустани Деда
18. Лош Дан 3');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Истоимена Песма
02. Бендови Из Главног Града
03. Браво
04. Лаж
05. Хоćу Да Пушим
06. Праслин
07. Стиже Беба
08. У Тераријуму
09. Као Бане (Не Тако Добри Син)
10. Шутнут
11. Сепса Је Управо Напустила Зграду
12. Лош Дан 4
13. Терање
14. Зуб Плагијатор
15. Опроштајна Песма
16. Самоубиство
17. Одустани Деда
18. Лош Дан 3');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_1_0.jpg');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_1_1.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2012.) ЗРОК: Последње Године');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2012.) ЗРОК: Последње Године');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Мемлах – Дубог
02. Импурита – Истина
03. Хyпе – Ерасе
04. Гуливер – Црни Фломастер
05. Боне Мацхине – Видим Све
06. Фуллтоне Поинт – Ункноwн Баллад
07. Хуррицане Бротхерс – 8 Троллеyс
08. Алтер Деус – Јуст Wаитинг
09. Крсташки Поход За Мајчином Спермом – Драгане Мајмуне
10. Неке Фаце – Море
11. Мадрес Егоистс – Психотерапија
12. Багљасх Компанела – Детонација
13. Непредвидиве Деде – Шума
14. Смена 8 – Дани Силоса');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Мемлах – Дубог
02. Импурита – Истина
03. Хyпе – Ерасе
04. Гуливер – Црни Фломастер
05. Боне Мацхине – Видим Све
06. Фуллтоне Поинт – Ункноwн Баллад
07. Хуррицане Бротхерс – 8 Троллеyс
08. Алтер Деус – Јуст Wаитинг
09. Крсташки Поход За Мајчином Спермом – Драгане Мајмуне
10. Неке Фаце – Море
11. Мадрес Егоистс – Психотерапија
12. Багљасх Компанела – Детонација
13. Непредвидиве Деде – Шума
14. Смена 8 – Дани Силоса');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_2_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2011.) ЗРОК: Историја Зрењанинског Роцк''Н''Ролла');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2011.) ЗРОК: Историја Зрењанинског Роцк''Н''Ролла');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', 'ЦД 01
01. Аца Đериć – Једну Ноć Са Тобом
02. Đорđе Војновиć – Жуљаве Руке И Каиш Сланине
03. Омеге – Ноćас
04. Милан Бојаниć – Ја Сам Остарио Свирајуćи Рок
05. Тетка Ана – Слатка Марија
06. Црвено И Црно – Пут До Звезда
07. Виндиго – Алсо Сцхпрах
08. Па Шта Онда – Промени Свој Свет
09. Спикери – Ти Градиш Социјализам
10. Јерусалимски Пилиćи – Иди Иди Моја Драга
11. Лила Дива – Без Ње
12. Масни Лебац – Весела Омладинска Песма
13. Џенин Портрет – Она
14. Прави Мачори – Бе-Боп-А-Лула
15. Расцеп Господина Каризмачинског – Плес Светлости
16. Вране – Промене
17. Др Yекyлл – Wир Wебен
18. Панта Шикља Нафта – Нафта
19. Тхе Фулл – Мескалито
ЦД 02
01. Глуве Кучке – Ружа
02. Инстант Карма – Сад И Ко Зна Кад
03. Фрее Схоп – Девојка Је Лопов
04. Канал Твид – Волим Што Смо Хладни
05. Јелена У Парку Јуре – Тамо Где Си Ти
06. Мамурно Јутро – Ко Си Стварно Ти
07. Редовна Ствар – Сада Знам
08. Тхе Ролингстонси – Навијачка Песма
09. Овердриве – Wаке Уп
10. Деметхер – Лацримоса
11. Група ЗР Рокера – Корак
12. Глоомy Оне – Цуттинг Сонг
13. Wладиwосток – Пуж
14. Гуливер – Небо Зови Ме
15. Сепса – Лош Дан
16. Паор Оф Лове – Хонкy Тонкy
17. Фуллтоне Поинт – Пуппет Тхеатер
18. Импурита – Баба
19. Беттy Бооп – Сама
20. Мемлах – Параноја');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', 'ЦД 01
01. Аца Đериć – Једну Ноć Са Тобом
02. Đорđе Војновиć – Жуљаве Руке И Каиш Сланине
03. Омеге – Ноćас
04. Милан Бојаниć – Ја Сам Остарио Свирајуćи Рок
05. Тетка Ана – Слатка Марија
06. Црвено И Црно – Пут До Звезда
07. Виндиго – Алсо Сцхпрах
08. Па Шта Онда – Промени Свој Свет
09. Спикери – Ти Градиш Социјализам
10. Јерусалимски Пилиćи – Иди Иди Моја Драга
11. Лила Дива – Без Ње
12. Масни Лебац – Весела Омладинска Песма
13. Џенин Портрет – Она
14. Прави Мачори – Бе-Боп-А-Лула
15. Расцеп Господина Каризмачинског – Плес Светлости
16. Вране – Промене
17. Др Yекyлл – Wир Wебен
18. Панта Шикља Нафта – Нафта
19. Тхе Фулл – Мескалито
ЦД 02
01. Глуве Кучке – Ружа
02. Инстант Карма – Сад И Ко Зна Кад
03. Фрее Схоп – Девојка Је Лопов
04. Канал Твид – Волим Што Смо Хладни
05. Јелена У Парку Јуре – Тамо Где Си Ти
06. Мамурно Јутро – Ко Си Стварно Ти
07. Редовна Ствар – Сада Знам
08. Тхе Ролингстонси – Навијачка Песма
09. Овердриве – Wаке Уп
10. Деметхер – Лацримоса
11. Група ЗР Рокера – Корак
12. Глоомy Оне – Цуттинг Сонг
13. Wладиwосток – Пуж
14. Гуливер – Небо Зови Ме
15. Сепса – Лош Дан
16. Паор Оф Лове – Хонкy Тонкy
17. Фуллтоне Поинт – Пуппет Тхеатер
18. Импурита – Баба
19. Беттy Бооп – Сама
20. Мемлах – Параноја');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_3_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2009.) ЗРОК ''09.');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2009.) ЗРОК ''09.');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', 'Зрењанински рок бендови имали су прилику да 25. и 26. септембра 2009. године засвирају на „Гитраијади”, некад веома популарној музичкој смотри, коју су након прекида дужег од једне деценије организовали Канцеларија за младе и Културни центар Зрењанина. Од 20 бендова пријављених на конкурс жири је изабрао 11 који су наступили на манифестацији и чије песме су заступљене на ЦД-у. Прве вечери наступили су „Канал Твид”, „Супер цонфусион”, „Мадерс егоистас”, „Сукоб интереса”, „Алтер деус” и „Фронтроw”, а наредне вечери „Импурита”, „Шишарке”, „Квазар”, „Алл еxцепт оне” и „ Мист” уз  гостујуćи бенд „Овердриве”. Покровитељи Зрењанинске гитаријаде били су Министрство културе Србије и Град Зрењанин.
01. Алл Еxцепт Оне – Wхат Ис Неxт То Цоме
02. Алтер Деус – Wхите Ас Yоу
03. Фронтроw & Зордан – Симе, Ноле, Бонг, Зорд
04. Импурита – Напрееед
05. Квазар – Ред Цараван ИИ-Фаллинг Старс
06. Мадрес Егоистас – Поштени Лопови
07. Мист – Он Фире
08. Овердриве – Сwаллоw
09. Шишарке – Ти Си Крај
10. Сукоб Интереса – Хвала
11. Супер Цонфусион – Балкан Еxпресс');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', 'Зрењанински рок бендови имали су прилику да 25. и 26. септембра 2009. године засвирају на „Гитраијади”, некад веома популарној музичкој смотри, коју су након прекида дужег од једне деценије организовали Канцеларија за младе и Културни центар Зрењанина. Од 20 бендова пријављених на конкурс жири је изабрао 11 који су наступили на манифестацији и чије песме су заступљене на ЦД-у. Прве вечери наступили су „Канал Твид”, „Супер цонфусион”, „Мадерс егоистас”, „Сукоб интереса”, „Алтер деус” и „Фронтроw”, а наредне вечери „Импурита”, „Шишарке”, „Квазар”, „Алл еxцепт оне” и „ Мист” уз  гостујуćи бенд „Овердриве”. Покровитељи Зрењанинске гитаријаде били су Министрство културе Србије и Град Зрењанин.
01. Алл Еxцепт Оне – Wхат Ис Неxт То Цоме
02. Алтер Деус – Wхите Ас Yоу
03. Фронтроw & Зордан – Симе, Ноле, Бонг, Зорд
04. Импурита – Напрееед
05. Квазар – Ред Цараван ИИ-Фаллинг Старс
06. Мадрес Егоистас – Поштени Лопови
07. Мист – Он Фире
08. Овердриве – Сwаллоw
09. Шишарке – Ти Си Крај
10. Сукоб Интереса – Хвала
11. Супер Цонфусион – Балкан Еxпресс');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_4_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2007.) Паор Оф Лове');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2007.) Паор Оф Лове');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '„Паор оф Лове” је прави представник алтернативног, кантри рок правца. Својом музиком, а пре свега луцидним и софистицираним текстовима, позивају на повратак здравом, сеоском животу.');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '„Паор оф Лове” је прави представник алтернативног, кантри рок правца. Својом музиком, а пре свега луцидним и софистицираним текстовима, позивају на повратак здравом, сеоском животу.');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_5_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2007.) Цантемус');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2007.) Цантемус');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Увертира Из Опере “Фигарова Женидба”
02. ВИИИ Руковет
03. Хвалите Господа С Небес
04. Ос Јусти
05. Отче Наш
06. Тиллиркотисса
07. Че Ти Не Бош Мој, Приредил
08. Јухе, Појдамо В Шкофцче
09. Лаулику Лапсеполи
10. Мала Ноćна Музика (И став)
11. Мy Лорд Wхат А Морнинг
12. Мала Ноćна Музика (ИВ став)
13. Опера “Чаробна Фрула (дует Папагено и Папагена)
14. Мисса Бревис
У сарадњи са Интернационалним музичким центром, сабрани су наступи учесника летошњег меđународног фестивала хорова „Кантемус”, чији је домаćин био Културни центар. Музички догаđај 2006. године у Зрењанину, уприличен на иницијативу хора „Коча Коларов” и под покровитељством Скупштине општине, окупио је хорове из Словеније, Кипра, Финске, Естоније и наше земље.');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Увертира Из Опере “Фигарова Женидба”
02. ВИИИ Руковет
03. Хвалите Господа С Небес
04. Ос Јусти
05. Отче Наш
06. Тиллиркотисса
07. Че Ти Не Бош Мој, Приредил
08. Јухе, Појдамо В Шкофцче
09. Лаулику Лапсеполи
10. Мала Ноćна Музика (И став)
11. Мy Лорд Wхат А Морнинг
12. Мала Ноćна Музика (ИВ став)
13. Опера “Чаробна Фрула (дует Папагено и Папагена)
14. Мисса Бревис
У сарадњи са Интернационалним музичким центром, сабрани су наступи учесника летошњег меđународног фестивала хорова „Кантемус”, чији је домаćин био Културни центар. Музички догаđај 2006. године у Зрењанину, уприличен на иницијативу хора „Коча Коларов” и под покровитељством Скупштине општине, окупио је хорове из Словеније, Кипра, Финске, Естоније и наше земље.');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_6_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2006.) Владимир Агиć Ага - Шапат Плочника');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2006.) Владимир Агиć Ага - Шапат Плочника');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Чекајуćи Бус
02. Гет Бацк
03. Кад Зажмурим… Замислим
04. Силазите Ли На Следеćој
05. Ни Круна, Ни Писмо
06.Пустите Ме Да Се Играм (са) Вама
07. Кад Зажмурим… Видим
08. Има Ли Шофера У Аутобусу
09. Портрети – Аутопортрети
10. Мангупима (интро)
11. Мангупима Са Оне Стране Времена
12. Yаллоw’с Гаy
13. Нека Буде – Замисли');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Чекајуćи Бус
02. Гет Бацк
03. Кад Зажмурим… Замислим
04. Силазите Ли На Следеćој
05. Ни Круна, Ни Писмо
06.Пустите Ме Да Се Играм (са) Вама
07. Кад Зажмурим… Видим
08. Има Ли Шофера У Аутобусу
09. Портрети – Аутопортрети
10. Мангупима (интро)
11. Мангупима Са Оне Стране Времена
12. Yаллоw’с Гаy
13. Нека Буде – Замисли');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_7_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2006.) Томислав Рајковиć - Славенске Приче');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2006.) Томислав Рајковиć - Славенске Приче');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Словенска Душа
02. Очи Љубави
03. Гривна
04. Хаљине Беле
05. Над Балканом
06. Ластавица
07. Док Тебе Сањам
08. Напуштена Земља');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Словенска Душа
02. Очи Љубави
03. Гривна
04. Хаљине Беле
05. Над Балканом
06. Ластавица
07. Док Тебе Сањам
08. Напуштена Земља');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_8_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2006.) Qуартет Плус - Стреет Јазз');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2006.) Qуартет Плус - Стреет Јазз');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Он Тхе Суннy Сиде
02. Софтлy
03. Тијуана Таxи
04. Монте Кристо
05. Амоур
06. Иит’с Онлy А Папер
07. Моон
08. Блацк Орпхеус
09. Синг, Синг
10. Тхе Тхирд Ман
11. Самба Фор Yоу
12. Тхе Нигхт Фаллс Силентлy
13. Гирл Фром Ипанема
14. Тицо-Тицо
15. Аппле Анд Цхеррис
16. Девојко Мала
17. Раин Дропс
18. Чамац На Тиси
19. Ла Цумпарасита');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Он Тхе Суннy Сиде
02. Софтлy
03. Тијуана Таxи
04. Монте Кристо
05. Амоур
06. Иит’с Онлy А Папер
07. Моон
08. Блацк Орпхеус
09. Синг, Синг
10. Тхе Тхирд Ман
11. Самба Фор Yоу
12. Тхе Нигхт Фаллс Силентлy
13. Гирл Фром Ипанема
14. Тицо-Тицо
15. Аппле Анд Цхеррис
16. Девојко Мала
17. Раин Дропс
18. Чамац На Тиси
19. Ла Цумпарасита');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_9_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2006.) Фуллтоне Поинт - Царусселл');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2006.) Фуллтоне Поинт - Царусселл');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '„Царусселл” бенда „Фуллтоне поинт” је диск чврстог рок звука – каже Ненад Божиć, музички уредник Културног центра. – Оно што га издваја је учешćе виолине, која својим звуком доприноси оригиналном и новом приступу рок музици.
Снимљено у студију „Фет фектори” у Зрењанину.');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '„Царусселл” бенда „Фуллтоне поинт” је диск чврстог рок звука – каже Ненад Божиć, музички уредник Културног центра. – Оно што га издваја је учешćе виолине, која својим звуком доприноси оригиналном и новом приступу рок музици.
Снимљено у студију „Фет фектори” у Зрењанину.');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_10_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2005.) ВИС Млекаџије - Немој Стати');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2005.) ВИС Млекаџије - Немој Стати');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Шта Ми Вреди
02. Позоришни Реггае
03. Окрени Се
04. Немој Стати Кад Ти Кажу “Стој”
05. Млекаџије');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Шта Ми Вреди
02. Позоришни Реггае
03. Окрени Се
04. Немој Стати Кад Ти Кажу “Стој”
05. Млекаџије');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_11_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2005.) Градски Дувачки Оркестар - Диxие Параде');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2005.) Градски Дувачки Оркестар - Диxие Параде');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Америцан Сwинг Марцх
02. Таннхаусер
03. Америцан Патрол
04. Ст. Лоуис Блуес
05 . Георге Герсхwин Ин Цонцерт
06. Смоке Он Тхе Wатер
07. Инстант Цонцерт
08. Диxие Параде');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Америцан Сwинг Марцх
02. Таннхаусер
03. Америцан Патрол
04. Ст. Лоуис Блуес
05 . Георге Герсхwин Ин Цонцерт
06. Смоке Он Тхе Wатер
07. Инстант Цонцерт
08. Диxие Параде');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_12_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2004.) Трибуте То Глоомy Оне');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2004.) Трибуте То Глоомy Оне');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Глуве Кучке – Фрозен Лове
02. Wладиwосток – Но Сецонд Тиме
03. Ивана & Шуки – Wхере То Го
04. Пункер – Доесн’т Хурт Еноугх
05. Пинк Цадиллац – Yоу Дон’т Wант
06. Импурита – Све Што Знам
07. Гнома – Све Је Погрешно Схваćено
08. Грумен – Све Што Знам
09. Цхрис Тхорпе – Wатерсхине
10. Марсхмаллоwс – Оут Оф Дреамс
11. Велики Презир – Цуттинг Сонг
14. Хуррицане Брос. – Ран Оут Оф Лаугх
15. Оwл Wинг – Све Је Погрешно Схваćено
16. Паор Оф Лове – Фресх Топлоокинг Модел');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Глуве Кучке – Фрозен Лове
02. Wладиwосток – Но Сецонд Тиме
03. Ивана & Шуки – Wхере То Го
04. Пункер – Доесн’т Хурт Еноугх
05. Пинк Цадиллац – Yоу Дон’т Wант
06. Импурита – Све Што Знам
07. Гнома – Све Је Погрешно Схваćено
08. Грумен – Све Што Знам
09. Цхрис Тхорпе – Wатерсхине
10. Марсхмаллоwс – Оут Оф Дреамс
11. Велики Презир – Цуттинг Сонг
14. Хуррицане Брос. – Ран Оут Оф Лаугх
15. Оwл Wинг – Све Је Погрешно Схваćено
16. Паор Оф Лове – Фресх Топлоокинг Модел');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_13_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2004.) Хор Јосиф Маринковиć - Српска Духовна Музика');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2004.) Хор Јосиф Маринковиć - Српска Духовна Музика');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Тебе Појем
02. Статија ИИИ
03. Њест Свјат
04. Херувимска Песма
05. Воспојте
06. Опело, б-мол');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Тебе Појем
02. Статија ИИИ
03. Њест Свјат
04. Херувимска Песма
05. Воспојте
06. Опело, б-мол');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_14_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2004.) Хор Јосиф Маринковиć - Духовна Музика');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2004.) Хор Јосиф Маринковиć - Духовна Музика');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Отче Наш
02. Богородице Ђево
03. Ниње Отпушцајеши
04. Ниње Отпушцајеши
05. Под Твоју Милост
06. Заступнице Усерднаја
07. Њест Свјат
08. Богородице Ђево
09. Свишњих Призираја
10. Салве Регина
11. Воспојте
12. Херувимска Пјесан
13. Опело, б-мол');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Отче Наш
02. Богородице Ђево
03. Ниње Отпушцајеши
04. Ниње Отпушцајеши
05. Под Твоју Милост
06. Заступнице Усерднаја
07. Њест Свјат
08. Богородице Ђево
09. Свишњих Призираја
10. Салве Регина
11. Воспојте
12. Херувимска Пјесан
13. Опело, б-мол');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_15_0.jpg');
INSERT INTO generic_element (type, category_id) VALUES ('Produkcija', 11);
SET @last_id = LAST_INSERT_ID();
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr-Cyrl', '(2004.) Глоомy Оне');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'naslov', 'sr', '(2004.) Глоомy Оне');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr-Cyrl', '01. Испочетка
02. Хаве Yоу Сеен Хер
03. Yоу Дон’т Wант
04. Ја Нисам…
05. Све Је Погрешно Схваćено
06. Фресх Топлоокинг Модел
07. Фрозен Лове
08. Yоур Фоол
09. Цутинг Сонг
10. Магиц Спелл
11. Оут Оф Дреамс
12. Доесн’т Хурт Еноугх
13. Алwаyс Хигх
14. Цомплеx Лифе
15. Цоитус
16. Тиме Травелинг
17. Неćу Да Будем Фармер
18. Хевенлy Хоме
19. Софа Миллионерс
20. Јуст Лике Yоу
21. Wхере То Го
22. Wатерсхине
23. Но Сецонд Тиме
24. Рун Оут Оф Лаугх');
INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (@last_id, 'generic_element', 'opis', 'sr', '01. Испочетка
02. Хаве Yоу Сеен Хер
03. Yоу Дон’т Wант
04. Ја Нисам…
05. Све Је Погрешно Схваćено
06. Фресх Топлоокинг Модел
07. Фрозен Лове
08. Yоур Фоол
09. Цутинг Сонг
10. Магиц Спелл
11. Оут Оф Дреамс
12. Доесн’т Хурт Еноугх
13. Алwаyс Хигх
14. Цомплеx Лифе
15. Цоитус
16. Тиме Травелинг
17. Неćу Да Будем Фармер
18. Хевенлy Хоме
19. Софа Миллионерс
20. Јуст Лике Yоу
21. Wхере То Го
22. Wатерсхине
23. Но Сецонд Тиме
24. Рун Оут Оф Лаугх');
INSERT INTO image (generic_element_id, file_path) VALUES (@last_id, '/uploads/muzika_16_0.jpg');

-- Kraj SQL fajla
