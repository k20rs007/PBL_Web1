-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-12-12 01:41:55
-- サーバのバージョン： 10.4.24-MariaDB
-- PHP のバージョン: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `pbl2022`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `t_genre`
--

CREATE TABLE `t_genre` (
  `rst_id` int(11) NOT NULL,
  `japanese_f` int(11) NOT NULL,
  `western_f` int(11) NOT NULL,
  `asian_f` int(11) NOT NULL,
  `curry` int(11) NOT NULL,
  `yakiniku` int(11) NOT NULL,
  `nabe` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `noodle` int(11) NOT NULL,
  `cafe` int(11) NOT NULL,
  `bread` int(11) NOT NULL,
  `liquor` int(11) NOT NULL,
  `others` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `t_genre`
--

INSERT INTO `t_genre` (`rst_id`, `japanese_f`, `western_f`, `asian_f`, `curry`, `yakiniku`, `nabe`, `restaurant`, `noodle`, `cafe`, `bread`, `liquor`, `others`) VALUES
(1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0),
(2, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 0),
(3, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1),
(4, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 0),
(7, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0),
(8, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 0),
(9, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0),
(10, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0),
(11, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0),
(12, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 0),
(13, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(14, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(15, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(16, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(17, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(18, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(19, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(20, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `t_open`
--

CREATE TABLE `t_open` (
  `rst_id` int(11) NOT NULL,
  `sunday` int(11) NOT NULL,
  `monday` int(11) NOT NULL,
  `tuesday` int(11) NOT NULL,
  `wednesday` int(11) NOT NULL,
  `thursday` int(11) NOT NULL,
  `friday` int(11) NOT NULL,
  `saturday` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `t_open`
--

INSERT INTO `t_open` (`rst_id`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`) VALUES
(1, 1, 1, 1, 0, 0, 1, 1),
(2, 1, 0, 0, 0, 0, 1, 1),
(3, 1, 1, 1, 1, 1, 1, 1),
(4, 0, 1, 0, 0, 0, 1, 0),
(5, 0, 0, 1, 0, 1, 0, 1),
(6, 1, 1, 0, 0, 1, 1, 1),
(7, 1, 1, 1, 1, 1, 1, 1),
(8, 0, 0, 1, 1, 1, 0, 1),
(9, 0, 1, 1, 1, 1, 1, 1),
(10, 1, 1, 0, 1, 1, 1, 1),
(11, 0, 1, 1, 1, 1, 1, 1),
(12, 1, 1, 1, 1, 1, 0, 0),
(13, 1, 1, 1, 1, 1, 0, 1),
(14, 0, 1, 1, 1, 1, 0, 1),
(15, 1, 1, 1, 1, 1, 0, 0),
(16, 1, 1, 0, 1, 1, 1, 1),
(17, 1, 1, 0, 1, 0, 1, 1),
(18, 1, 1, 1, 1, 1, 0, 1),
(19, 1, 1, 1, 1, 0, 1, 1),
(20, 1, 1, 1, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `t_review`
--

CREATE TABLE `t_review` (
  `review_id` bigint(20) UNSIGNED NOT NULL COMMENT '口コミID',
  `eval_point` int(11) NOT NULL COMMENT '評価点, 1..5',
  `review_comment` varchar(1024) NOT NULL COMMENT 'コメント',
  `rst_id` bigint(20) NOT NULL COMMENT '店舗ID',
  `user_id` varchar(32) NOT NULL COMMENT '登録ユーザID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='口コミ';

--
-- テーブルのデータのダンプ `t_review`
--

INSERT INTO `t_review` (`review_id`, `eval_point`, `review_comment`, `rst_id`, `user_id`) VALUES
(1, 4, 'メニューも豊富でしたがいかんせんお腹がいっぱいでそんなにお料理を頼む事ができませんでしたが創作料理的なメニューが多い印象でした。', 1, 'u007'),
(2, 5, 'この店は、お肉のボリュームが有って安い、肉好きの聖地。', 2, 'u003'),
(3, 4, 'お酒好きの多い、ちょっとグルメな人たち」向けのお店だと思いました。 ', 1, 'u001'),
(4, 4, '透き通った活ヤリイカは禁断の美味しさ！活造りだけでは終わらないよ～', 3, 'u002'),
(5, 3, '駅から遠いのが難点だが、それでもまた利用したいお店', 1, 'u010');

-- --------------------------------------------------------

--
-- テーブルの構造 `t_rstinfo`
--

CREATE TABLE `t_rstinfo` (
  `rst_id` bigint(20) UNSIGNED NOT NULL COMMENT '店舗ID',
  `rst_name` varchar(64) NOT NULL COMMENT '店舗名',
  `rst_address` varchar(256) DEFAULT NULL COMMENT '住所',
  `start_time_weekday` time NOT NULL COMMENT '営業開始時間(平日)',
  `end_time_weekday` time NOT NULL COMMENT '営業終了時間(平日)',
  `start_time_holiday` time NOT NULL COMMENT '営業開始時間(休日)',
  `end_time_holiday` time NOT NULL COMMENT '営業修了時間(休日)',
  `tel_num` varchar(32) NOT NULL COMMENT '電話番号',
  `rst_info` text NOT NULL COMMENT '店舗情報:店舗の概要・オススメなど',
  `rst_photo` varchar(32) NOT NULL,
  `photo1` varchar(32) NOT NULL,
  `photo2` varchar(32) NOT NULL,
  `photo3` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL COMMENT '登録ユーザID:店舗を登録したユーザのID',
  `takeout` int(11) DEFAULT NULL COMMENT '可能1、不可0',
  `delivery` int(11) DEFAULT NULL COMMENT '可能1、不可0',
  `holiday_detail` text DEFAULT NULL COMMENT '定休日備考',
  `rst_url` varchar(2048) DEFAULT NULL COMMENT '店舗のurl',
  `menu_detail` text DEFAULT NULL COMMENT 'メニューの説明',
  `budget_min` int(32) NOT NULL COMMENT '予算の最小',
  `budget_max` int(32) NOT NULL COMMENT '予算の最大',
  `delivery_url` varchar(2048) NOT NULL,
  `genre` varchar(32) DEFAULT NULL COMMENT 'ジャンル:店舗のジャンル名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='店舗情報';

--
-- テーブルのデータのダンプ `t_rstinfo`
--

INSERT INTO `t_rstinfo` (`rst_id`, `rst_name`, `rst_address`, `start_time_weekday`, `end_time_weekday`, `start_time_holiday`, `end_time_holiday`, `tel_num`, `rst_info`, `rst_photo`, `photo1`, `photo2`, `photo3`, `user_id`, `takeout`, `delivery`, `holiday_detail`, `rst_url`, `menu_detail`, `budget_min`, `budget_max`, `delivery_url`, `genre`) VALUES
(1, '居酒屋 ひなた', '福岡県福岡市中央区今泉2丁目3-31 プロペリスタ今泉Ⅱ　１階', '18:00:00', '03:00:00', '00:00:00', '00:00:00', '050-1234-5678', '福岡市にある【ひなた】は路地裏にある隠れ家的居酒屋。一歩中に入ると、活気にあふれたスタッフの声が響く、シックでモダンな和風の内装のお店です。料理は九州のうまい料理 ”もつ鍋” \"水炊\" \"お刺身\" \"博多地鶏\"等を取り揃えております。タッフの心配りも細やかなので、一人でも気軽に立ち寄れるお店です。遅い仕事帰りの方にも嬉しい深夜3時までの営業も魅力。', 'rst1_photo1.jpg', 'rst2_photo1.jpg', 'rst3_photo1.jpg', 'osake.jpg', 'u002', 1, 1, '第3月曜日はお休みです。', 'https://unity-hinata.owst.jp/', 'コースメニュー\r\n・有田直送ごどうふ冷奴\r\n\r\n・蒸し鶏のトロロサラダ\r\n\r\n・名物ポテトサラダ（おかわり自由）\r\n\r\n・長浜直送　お刺身３点盛\r\n\r\n・牛タンのスジポン酢\r\n\r\n・大根の唐揚げ\r\n\r\n・せせり鉄板\r\n\r\n・牛タンの炙り\r\n\r\n・鯛茶漬け', 2000, 3500, 'https://demae-can.com/', '居酒屋、もつ鍋、魚介料理・海鮮料理'),
(2, '肉が一番', '福岡県福岡市中央区高砂1-5-10', '17:30:00', '22:30:00', '00:00:00', '00:00:00', '050-3245-1079', '前日までのご予約の際に、記念日やお祝い等のご利用との旨をお伝えいただけますと、細やかながらシャンパンのサービスをさせて頂きます。・お祝い・サプライズについては、ご予約時など事前にご相談ください。※paypayご利用いただけます。', 'rst1_photo2.jpg', '1_mainyakiniku.jpg', '2_mainyakiniku.jpg', '3_mainyakiniku.jpg', 'u001', 1, 0, '食材が無くなったら店を閉めます。', 'https://tabelog.com/fukuoka/A4001/A400104/40041051/', 'メインの鍋を、もつ鍋、チゲ鍋、黒豚しゃぶしゃぶの三種類からお選びいただけるコース！ ローストビーフや、ステーキもあるので、様々なお肉を存分にお楽しみいただけます！ 3名様以上からOK！ 友達、同僚などの飲み会にもお使いください。', 2500, 4000, '', 'ステーキ、すき焼き、しゃぶしゃぶ'),
(3, '天王福岡店', '福岡県福岡市中央区春吉3-21-28 ﾛﾏﾈｽｸﾘｿﾞｰﾄ西中洲６階', '17:00:00', '03:00:00', '00:00:00', '00:00:00', '050-3456-2333', '野菜料理にこだわる、魚料理にこだわる、健康・美容メニューあり。日本酒あり、焼酎あり、ワインあり、カクテルあり、日本酒にこだわる、焼酎にこだわる、ワインにこだわる、カクテルにこだわる', 'rst1_photo3.jpg', 'others.jpg', '', '', 'u001', 0, 0, '祝日は休みです。', 'https://tenou-fukuoka.com/', '+1650円で2時間飲放付◆1日3組限定の特割コースです。朝〆いかの姿造りに長浜市場直送のお造り盛り合わせ、地鶏のもも炭火焼き、ブリの塩焼き、そして鍋は国産もつ鍋・塩ちゃんこ鍋から選べる充実のコース内容。1日3組限定でご案内いたします。', 3500, 6000, '', '居酒屋、郷土料理（その他）、もつ鍋'),
(4, '焼肉 武蔵', '福岡県東区松香台２丁目３-１', '19:00:00', '01:30:00', '19:00:00', '01:30:00', '052-937-0606', '【千種駅・車道駅から徒歩約5分】当店の自慢は《牛タン》。', '1_mainyakiniku.jpg', '', '', '', 'u001', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(5, '焼肉 次郎', NULL, '14:00:00', '22:00:00', '14:00:00', '22:00:00', '1234-56-7891', '松阪牛のお店です。', '2_mainyakiniku.jpg', '', '', '', 'u003', NULL, NULL, NULL, NULL, NULL, 2000, 5000, '', '焼肉'),
(6, '焼肉 三郎', NULL, '18:00:00', '01:00:00', '18:00:00', '01:00:00', '1234-56-7892', '宮崎牛が一押しです。', '3_mainyakiniku.jpg', '', '', '', 'u002', NULL, NULL, NULL, NULL, NULL, 4000, 8000, '', NULL),
(7, '焼肉 大助', NULL, '15:00:00', '23:30:00', '00:00:00', '23:30:00', '1234-56-7892', '神戸牛専門店です。', '1_mainyakiniku.jpg', '', '', '', 'u001', NULL, NULL, NULL, NULL, NULL, 3000, 4000, '', NULL),
(8, '焼肉 助朗', NULL, '11:00:00', '22:00:00', '11:00:00', '22:00:00', '1234-56-7893', 'リーズナブルな食べ放題です。', '2_mainyakiniku.jpg', '', '', '', 'u002', 0, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(9, '焼肉 候', NULL, '22:00:00', '01:00:00', '22:00:00', '01:00:00', '1234-56-7894', '予約制の個室焼肉店です。', '3_mainyakiniku.jpg', '', '', '', 'u003', NULL, NULL, NULL, NULL, NULL, 4000, 8000, '', NULL),
(10, '居酒屋 こなた', NULL, '17:00:00', '01:00:00', '17:00:00', '01:00:00', '1234-56-7895', 'いろんなお酒を置いています。', 'osake.jpg', '', '', '', 'u004', NULL, NULL, NULL, NULL, NULL, 1500, 3000, '', NULL),
(11, 'もつ鍋専門店 かなた', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-56-1234', 'もつ鍋専門店です', 'rst1_photo1.jpg', 'nabe.jpg', '', '', 'u005', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(12, '肉屋 そなた', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-56-1236', '種類が豊富な焼肉屋です', 'rst1_photo2.jpg', '', '', '', 'u006', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(13, '魚介専門点 ひらた', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-56-1238', '鮮度が売りです', 'rst1_photo3.jpg', 'wasyoku.jpg', '', '', 'u007', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(14, '居酒屋 ひまだ', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-56-1228', 'リーズナブルな食べ放題が売りです', 'rst1_photo1.jpg', 'osake.jpg', '', '', 'u008', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(15, '博多地鶏専門店 ひんな', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-56-1282', 'リーズナブルな食べ放題が売りです', 'rst1_photo2.jpg', '', '', '', 'u009', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(16, '居酒屋 鶴見', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-56-1294', 'リーズナブルな食べ放題が売りです', 'rst1_photo3.jpg', '', '', '', 'u010', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(17, '居酒屋 まな', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-56-1236', 'リーズナブルな食べ放題が売りです', 'rst1_photo1.jpg', '', '', '', 'u001', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(18, 'もんじゃ専門店 KYUSAN', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-56-1279', '種類が豊富です', 'rst1_photo2.jpg', '', '', '', 'u002', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(19, '樫井そば', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-56-1388', '種類が豊富です', 'rst1_photo3.jpg', '', '', '', 'u003', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(20, '定食屋 ズンドコ', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-56-1937', '種類が豊富です', 'rst1_photo1.jpg', '', '', '', 'u004', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(21, '居酒屋 かざい', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-56-1372', '種類が豊富です', 'rst1_photo2.jpg', '', '', '', 'u005', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(22, 'ピザ専門店 ピッザニア', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-55-1234', '種類が豊富です', 'rst1_photo3.jpg', '', '', '', 'u006', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(23, 'ゲルニカ', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-82-1234', '種類が豊富です', 'rst1_photo1.jpg', '', '', '', 'u007', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL),
(24, '喫茶 NULL', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1234-29-1234', '種類が豊富です', 'rst1_photo2.jpg', 'cafe.jpg', '', '', 'u001', NULL, NULL, NULL, NULL, NULL, 0, 0, '', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `t_user`
--

CREATE TABLE `t_user` (
  `user_id` varchar(32) NOT NULL COMMENT 'ユーザID:ユーザのログインID',
  `user_name` varchar(32) NOT NULL COMMENT 'アカウント名:ユーザの氏名',
  `user_kana` varchar(32) DEFAULT NULL COMMENT 'アカウント名（カナ）:ユーザの氏名（カナ）',
  `password` varchar(32) NOT NULL COMMENT 'パスワード:ユーザのログインパスワード',
  `usertype_id` varchar(1) NOT NULL COMMENT 'ユーザ種別ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='ユーザ';

--
-- テーブルのデータのダンプ `t_user`
--

INSERT INTO `t_user` (`user_id`, `user_name`, `user_kana`, `password`, `usertype_id`) VALUES
('admin', '管理者', 'カンリシャ', '5678', '9'),
('t003', 'ゲスト3', 'ゲスト3', '3456', '2'),
('u001', '渡部 妃菜', 'ワタベ ヒナ', '1234', '1'),
('u002', '安田 敬太', 'ヤスダ ケイタ', '1234', '1'),
('u003', '前田 稟', 'マエダ リン', '1234', '1'),
('u004', '山本 明莉', 'ヤマモト アカリ', '1234', '1'),
('u005', '斉藤 万葉', 'サイトウ マヨ', '1234', '1'),
('u006', '高野 歩', 'タカノ アユミ', '1234', '1'),
('u007', '尾崎 沙織', 'オザキ サオリ', '1234', '1'),
('u008', '菅原 直子', 'スガハラ ナオコ', '1234', '1'),
('u009', '大島 ゆら', 'オオシマ ユラ', '1234', '1'),
('u010', '中西 陽花', 'ナカニシ ヨウカ', '1234', '1');

-- --------------------------------------------------------

--
-- テーブルの構造 `t_usertype`
--

CREATE TABLE `t_usertype` (
  `usertype_id` varchar(1) NOT NULL COMMENT 'ユーザ種別ID',
  `usertype` varchar(16) NOT NULL COMMENT 'ユーザ種別:ユーザ種別名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='ユーザ種別';

--
-- テーブルのデータのダンプ `t_usertype`
--

INSERT INTO `t_usertype` (`usertype_id`, `usertype`) VALUES
('1', '社員'),
('2', 'ゲスト'),
('9', '管理者');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `t_genre`
--
ALTER TABLE `t_genre`
  ADD PRIMARY KEY (`rst_id`);

--
-- テーブルのインデックス `t_open`
--
ALTER TABLE `t_open`
  ADD PRIMARY KEY (`rst_id`);

--
-- テーブルのインデックス `t_review`
--
ALTER TABLE `t_review`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `review_id` (`review_id`);

--
-- テーブルのインデックス `t_rstinfo`
--
ALTER TABLE `t_rstinfo`
  ADD PRIMARY KEY (`rst_id`),
  ADD UNIQUE KEY `rst_id` (`rst_id`);

--
-- テーブルのインデックス `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- テーブルのインデックス `t_usertype`
--
ALTER TABLE `t_usertype`
  ADD PRIMARY KEY (`usertype_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `t_review`
--
ALTER TABLE `t_review`
  MODIFY `review_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '口コミID', AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `t_rstinfo`
--
ALTER TABLE `t_rstinfo`
  MODIFY `rst_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '店舗ID', AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
