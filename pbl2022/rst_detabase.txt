ALTER TABLE `t_rstinfo` ADD `TAKEOUT` INT NOT NULL COMMENT '可能1、不可0' AFTER `user_id`;

ALTER TABLE `t_rstinfo` ADD `DELIVERY` INT NOT NULL COMMENT '可能1、不可0' AFTER `user_id`;

ALTER TABLE `t_rstinfo` ADD `HOLIDAY_DETAIL` TEXT NOT NULL COMMENT '定休日備考' AFTER `TAKEOUT`;

ALTER TABLE `t_rstinfo` ADD `RST_PHOTO` MEDIUMBLOB NOT NULL AFTER `HOLIDAY_DETAIL`;

ALTER TABLE `t_rstinfo` CHANGE `photo1` `photo1` MEDIUMBLOB NULL DEFAULT NULL COMMENT '写真1';

ALTER TABLE `t_rstinfo` CHANGE `photo2` `photo2` MEDIUMBLOB NULL DEFAULT NULL COMMENT '写真2';

ALTER TABLE `t_rstinfo` CHANGE `photo3` `photo3` MEDIUMBLOB NULL DEFAULT NULL COMMENT '写真3';

ALTER TABLE `t_rstinfo` ADD `RST_URL` VARCHAR(2048) NOT NULL COMMENT '店舗のurl' AFTER `RST_PHOTO`, ADD `MENU_DETAIL` TEXT NOT NULL COMMENT 'メニューの説明' AFTER `RST_URL`, ADD `BUDGET_MAX` INT(32) NOT NULL COMMENT '予算の最大' AFTER `MENU_DETAIL`, ADD `BUDGET_MIN` INT(32) NOT NULL COMMENT '予算の最小' AFTER `BUDGET_MAX`;

UPDATE `t_rstinfo` SET `user_id` = '2', `DELIVERY` = '1', `TAKEOUT` = '1', `HOLIDAY_DETAIL` = '第3月曜日はお休みです。', `RST_URL` = 'https://unity-hinata.owst.jp/', `MENU_DETAIL` = 'コースメニュー\r\n・有田直送ごどうふ冷奴\r\n\r\n・蒸し鶏のトロロサラダ\r\n\r\n・名物ポテトサラダ（おかわり自由）\r\n\r\n・長浜直送　お刺身３点盛\r\n\r\n・牛タンのスジポン酢\r\n\r\n・大根の唐揚げ\r\n\r\n・せせり鉄板\r\n\r\n・牛タンの炙り\r\n\r\n・鯛茶漬け', `BUDGET_MAX` = '2000', `BUDGET_MIN` = '3500' WHERE `t_rstinfo`.`rst_id` = 1;

UPDATE `t_rstinfo` SET `user_id` = '1', `TAKEOUT` = '1', `HOLIDAY_DETAIL` = '食材が無くなったら店を閉めます。', `RST_URL` = 'https://tabelog.com/fukuoka/A4001/A400104/40041051/', `MENU_DETAIL` = 'メインの鍋を、もつ鍋、チゲ鍋、黒豚しゃぶしゃぶの三種類からお選びいただけるコース！ ローストビーフや、ステーキもあるので、様々なお肉を存分にお楽しみいただけます！ 3名様以上からOK！ 友達、同僚などの飲み会にもお使いください。', `BUDGET_MAX` = '2500', `BUDGET_MIN` = '4000' WHERE `t_rstinfo`.`rst_id` = 2;

UPDATE `t_rstinfo` SET `user_id` = '5', `HOLIDAY_DETAIL` = '祝日は休みです。', `RST_URL` = 'https://tenou-fukuoka.com/', `MENU_DETAIL` = '+1650円で2時間飲放付◆1日3組限定の特割コースです。朝〆いかの姿造りに長浜市場直送のお造り盛り合わせ、地鶏のもも炭火焼き、ブリの塩焼き、そして鍋は国産もつ鍋・塩ちゃんこ鍋から選べる充実のコース内容。1日3組限定でご案内いたします。', `BUDGET_MAX` = '3500', `BUDGET_MIN` = '6000' WHERE `t_rstinfo`.`rst_id` = 3;