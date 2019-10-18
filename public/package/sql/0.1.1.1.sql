
-- 导出  表 dh_cms.dh_article 结构
CREATE TABLE IF NOT EXISTS `dh_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `title` char(50) NOT NULL,
  `author` char(50) NOT NULL,
  `uri` char(50) NOT NULL,
  `tag` char(50) NOT NULL,
  `thumb` char(255) NOT NULL,
  `desc` char(255) NOT NULL,
  `views` int(10) NOT NULL DEFAULT '0',
  `sort` int(10) NOT NULL DEFAULT '0',
  `category_id` int(10) NOT NULL DEFAULT '0',
  `status` int(10) NOT NULL DEFAULT '0',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `comment_num` int(11) NOT NULL COMMENT '评论数量',
  `etime` int(11) NOT NULL COMMENT '编辑时间',
  `ptime` int(11) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`),
  KEY `views` (`views`),
  KEY `category_id` (`category_id`),
  KEY `comment_num` (`comment_num`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- 正在导出表  dh_cms.dh_article 的数据：0 rows
/*!40000 ALTER TABLE `dh_article` DISABLE KEYS */;
INSERT INTO `dh_article` (`id`, `member_id`, `title`, `author`, `uri`, `tag`, `thumb`, `desc`, `views`, `sort`, `category_id`, `status`, `ctime`, `comment_num`, `etime`, `ptime`) VALUES
	(1, 0, '碧喧恬萄俐店辉活伯', '点鹤', '95767921AF0CAD281F2947A7E5401E0D', '点鹤CMS', '', '行履赊察抿多肋褒翠虏椭嫌，蜗骄邻垂扎屁砒粘惨匆馅记。', 0, 0, 1, 1, 1531017856, 0, 0, 1530979200),
	(2, 0, '牙头缓郡悦', '点鹤', '3FB8BD214188A224821245A65DDC3CFB', '点鹤', '', '抉青巡乌姥钡找碧句年治拥，你郎量淳惠塞迢户美帚竟濒。\n\n', 0, 0, 3, 1, 1531018076, 0, 0, 1530979200);
/*!40000 ALTER TABLE `dh_article` ENABLE KEYS */;


-- 导出  表 dh_cms.dh_article_content 结构
CREATE TABLE IF NOT EXISTS `dh_article_content` (
  `id` int(11) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章内容表';

-- 正在导出表  dh_cms.dh_article_content 的数据：0 rows
/*!40000 ALTER TABLE `dh_article_content` DISABLE KEYS */;
INSERT INTO `dh_article_content` (`id`, `content`) VALUES
	(1, '&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;行履赊察抿多肋褒翠虏椭嫌，蜗骄邻垂扎屁砒粘惨匆馅记。&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;什革孤纳，抡窃寺缠，匡佯阿莆豌所锅鸣禁，潍余渗乌都大习秸碍，刻凶啤身檬忧瑞，蓟廉答晾儒朔诱燕愉廖。窃描汰钝沧信留，罢拒劳钨惭雁腑起寿，酗哇酪乍炳，琵琶斜攒痴况姚眨装。烧程象，&ldquo;抗旱拔戌，述般弃询，酒博忙肤戈徐混厦！&rdquo;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;训钙譬蛮，署拌溅惊哑蒜裔，幽耸悟俺支；绑设介柔糊晴看撼尽阎启然，蚕扳凤括亭痘。胆伪照隅弊离，膨逸汐纱屑漓拖，婴枕右涝夏洋宴侵蜡照满黔打疚势。痒皱兰裤荧噎莹，铆坊授负。搬脆旭猪嗡甥郴，烬守腋骸银蜀；彻坟握促吹川。倾恨虽躯帛瞄佃室琵，伶贴靡华穿禽斟惰掇，倦环咒淹滁垂抖淀芦。谤絮配玩枣谜，槛菇丙酣贷蚁铲破诽猎鞭。闺压辩穗娜陨晴距淖；览掸葫，&ldquo;彭柠概，谨感核辖算！&rdquo;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;跋妖巍，&ldquo;抉占，磊琴略。&rdquo;星祈伍借萄谷灭，澄，&ldquo;哩榆妥升掘养兑。辊勤防掇臃，薯乙俄扁。&rdquo;煮谩合收蕴皑恬舵溅遮仪卑汉四菠丫侄挑禹段速。舍摩僻盈撮焦，绍撮安忽瓷，侵喧广铡森锻膝减。疲扑襄访刑江栖，士黍诣强疫讶脉簇为。摹苔选嵌只盅，存掷陈，尚航绩皮市。肌焕憨麓抉丈驯谎凄恃，撞慈牛彰丁赞举，心痛撩沃寒，禄枪烁厂矫掺孤捞，辨极摧央搽澎，徐他盒岛。靶秸洱碘婆屋荣，湿殴帐趋牲喂碎，藤猛炔赔羔。稼湘遇烃摄寄垮觉，干蜗藐行舅灌；托桂庄升懈详观绘背员，秧拖芝匈镊册敬。惠簿吠嘶后垫邪看瘴，盔御携斯谦勉多肖抚诞。岔震快曳锈浑躇，鹿诌胸充，壤鸣赎饼斧津。硷摔悄遗面隔，这职啼进蝴干货梨裸伤挠耕命。司蛾歧诫，谐犁竞欣圆鱼孙飞铺凡，嫉相蔑榔窗瑞，渺昆斥原维值。驳湾造语，孝搏烷蔽趴挞。也溺歌礁粘冲符，丹库狗滞卓府按佳宏甥赌持肇抑侄。撕狄援粹迈翠泡拓国，掘惯涌燎斋电蜡，爱存酒磁，&ldquo;乡争色；铬衡琴娟渤！&rdquo;腆牌折刽驼摧眺。簇客凉卿跑，谤瓣瞒蛋肛玫，听，&ldquo;撬妥炕，委硼锚屈。&rdquo;琵滥坟壳垢汀捅饮矛围搽剁杯壹，渗恫疫拧掇，劈祁皱或话窥，面尹近烟蛤绊帅。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
	(2, '&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;抉青巡乌姥钡找碧句年治拥，你郎量淳惠塞迢户美帚竟濒。&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;眠君松伊党蹬，棒囚惑饵缄鸿；陶腆万乾阿隙扰。霖翼鞋没，历弛斟骏贸汲他洋，标丑犹舟穷隆，厉寡叁硅揩富驹蚌。虐铣爹丹，城霉浸柏枝汁侠什，何奸触藉穗娱辛塑，脑掏奸逮猪。&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;高液叹择宇，驳磕冈状。论柔虚，逞贡镭赤优型桔。续痉朽魁广，蕴戮几铺讹荤拘琶，黑拙易黑。破苔歹皂首碳溢拒乓严肚。擦饿持劝帆普莽戴祷，溯脆领盔拌时崩条卑，妒玻迭粉磋捕铁。厨空评兜侧芹砾培烯；腑径催古樟。檀钡计喇椅牌求必辕烧择默沤健；百岭聚壁烁隔老噎蚊情隧衔评沥工。耿闽酶宰考贰魏，衷捞郑益阿，园俩谅誊。龋甸蛾恨捞窟镇弧椰风。虚戳斑岂仆囱酮茵；彰逝克淑怂摩，搭庄展糙薪滁受！榴巍耕脖熟宛舟忆栗咳，订燎看蕴境试它荔螺徐？府，落蟹牙醋整，钙唬曹内摘灯添猖！&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;炕缕交，&ldquo;傣之，吮痒樟。&rdquo;焕藕迟夹廖亨忱，天，&ldquo;冗峙劝搂良施枚。岗盟孵碰烬，茸划液唤。&rdquo;除屉粟赢伦鞘赎疽菏拌略蛆誓饺持变盟求松隅桑。袜四肇抡逞绦，经蚕妹陋霓，陈菠店下花兰铜目。冲脓隙茂龄犊巡，慌掩脱抄磺葬镭弃寞。集恫墒粱矩傈，删舟稳，瞧今菱菩加。舟翱兔迁藻拢猜湃叉僧，犀艾郊捻曰肋之，计谬宁桓鄙，寞炮久一侄穷骚促，缚瞳怜浸照应，眨疆庶卤。国缨分抹鹏取绸，扫蚂熙胺仍栽像，礼挂回譬泊。漏透鄂轿猎堪停眶，近胆妻立倪江；痢湘蔷拔卸阑裳拽芦叛，谈刊末誉吸饼敷。蚊锈担捏光规种筛舔，氦饺辱楔躲播唁埃逃慨。灯改栗卧亢晤戈，逊时铭形，尺毛季誊筐汲。雹势括泽昼侨，乡渣舌稳伟蕴庄般峡谣秋耍问。壕闷鹅卷，朵鹊陵芝珍淌疡洼贸篙，纠辕雷堕跋霓，茸奉精漱凉闽。莉攻褒补，盆默埃迂仪阐。京钵炭梦输绍帛，掸狱啸海饯戒舌血仓陪谜箩赘购衫。社加湍隋取件呛辣矿，妹孰卫截积郊亦，讯纫霄裁，&ldquo;偏卢狈；一阎香神依！&rdquo;校锋击嫌尝线间。捷屁楔刁笨，还缕笺很冉莆，棒，&ldquo;醚思倔，职碧吁迂。&rdquo;罗脆募尺绅肿诞沏湖裕房狂汀毫，蛀轰步恰埠，掂烽渔向弧记，予澡凋券彝赛刷。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;');
/*!40000 ALTER TABLE `dh_article_content` ENABLE KEYS */;


-- 导出  表 dh_cms.dh_article_tag 结构
CREATE TABLE IF NOT EXISTS `dh_article_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 正在导出表  dh_cms.dh_article_tag 的数据：0 rows
/*!40000 ALTER TABLE `dh_article_tag` DISABLE KEYS */;
INSERT INTO `dh_article_tag` (`id`, `article_id`, `tag_id`, `ctime`) VALUES
	(1, 1, 1, 1531017857),
	(2, 2, 2, 1531018076);
/*!40000 ALTER TABLE `dh_article_tag` ENABLE KEYS */;


-- 导出  表 dh_cms.dh_banner 结构
CREATE TABLE IF NOT EXISTS `dh_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '位置 1首页大图',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1显示0隐藏',
  `ctime` tinyint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ban\r\nban\r\nbanner';

-- 正在导出表  dh_cms.dh_banner 的数据：0 rows
/*!40000 ALTER TABLE `dh_banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `dh_banner` ENABLE KEYS */;


-- 导出  表 dh_cms.dh_category 结构
CREATE TABLE IF NOT EXISTS `dh_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `parent_id` int(11) DEFAULT '0' COMMENT '父类',
  `name` char(50) DEFAULT NULL,
  `seo_keywords` char(50) DEFAULT NULL,
  `seo_description` char(50) DEFAULT NULL,
  `seo_title` char(50) DEFAULT NULL,
  `url_name` char(50) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1' COMMENT '1列表2 单页面',
  `status` tinyint(1) DEFAULT '0' COMMENT '1显示  0隐藏',
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='类别';

-- 正在导出表  dh_cms.dh_category 的数据：6 rows
/*!40000 ALTER TABLE `dh_category` DISABLE KEYS */;
INSERT INTO `dh_category` (`id`, `sort`, `parent_id`, `name`, `seo_keywords`, `seo_description`, `seo_title`, `url_name`, `type`, `status`, `ctime`) VALUES
	(1, 1, 0, '新闻列表', '新闻列表', '新闻列表', '新闻列表', 'newsList', 1, 1, 1514714003),
	(2, 2, 0, '关于我们', '关于我们', '', '', 'about', 2, 1, 1515338530),
	(3, 4, 0, '最新新闻', '最新新闻', '最新新闻', '最新新闻', 'news', 1, 1, 1514713998),
	(4, 2, 0, '公司简介', '公司简介', '公司简介', '公司简介', 'jianjie', 1, 1, 1514714000),
	(7, 0, 0, '测试', '测试', '测试', '测试', 'ceshi', 2, 1, 1515340288),
	(9, 1, 4, '公司来源', '公司', '我们的公司', '公司来源', 'laiyuan', 1, 1, 1517358527);
/*!40000 ALTER TABLE `dh_category` ENABLE KEYS */;


-- 导出  表 dh_cms.dh_link 结构
CREATE TABLE IF NOT EXISTS `dh_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `sort` int(4) NOT NULL,
  `name` char(50) NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- 正在导出表  dh_cms.dh_link 的数据：1 rows
/*!40000 ALTER TABLE `dh_link` DISABLE KEYS */;
INSERT INTO `dh_link` (`id`, `url`, `sort`, `name`, `ctime`) VALUES
	(1, 'www.bubaiso.com', 2, '不白搜', 1514903935);
/*!40000 ALTER TABLE `dh_link` ENABLE KEYS */;


-- 导出  表 dh_cms.dh_member 结构
CREATE TABLE IF NOT EXISTS `dh_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) NOT NULL,
  `name` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `ctime` int(10) NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1男 2为女',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1为可用 0为不可用',
  `login_ip` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

-- 正在导出表  dh_cms.dh_member 的数据：1 rows
/*!40000 ALTER TABLE `dh_member` DISABLE KEYS */;
INSERT INTO `dh_member` (`id`, `username`, `name`, `password`, `ctime`, `sex`, `status`, `login_ip`) VALUES
	(1, 'admin', '管理员', 'e10adc3949ba59abbe56e057f20f883e', 1514905540, 1, 1, '127.0.0.1');
/*!40000 ALTER TABLE `dh_member` ENABLE KEYS */;


-- 导出  表 dh_cms.dh_role 结构
CREATE TABLE IF NOT EXISTS `dh_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` char(50) DEFAULT NULL,
  `value` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限管理表';

-- 正在导出表  dh_cms.dh_role 的数据：0 rows
/*!40000 ALTER TABLE `dh_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `dh_role` ENABLE KEYS */;


-- 导出  表 dh_cms.dh_single_page 结构
CREATE TABLE IF NOT EXISTS `dh_single_page` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `author` char(50) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `ctime` int(11) unsigned NOT NULL,
  `views` int(11) unsigned NOT NULL,
  `ptime` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='单页面数据';

-- 正在导出表  dh_cms.dh_single_page 的数据：0 rows
/*!40000 ALTER TABLE `dh_single_page` DISABLE KEYS */;
INSERT INTO `dh_single_page` (`id`, `category_id`, `title`, `desc`, `author`, `content`, `ctime`, `views`, `ptime`) VALUES
	(2, 7, '呼耀仓蹈馁硝隧然解', '点鹤CMS', '点鹤', '&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;怔虎漓平硒萍粤熊铜晶烃凋，舆万倒苦酸委醛瘸辙刺匹鹤。&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;秧史硫外稠坪，渺呼鼠果谗怀；讽碑伴愈遂爷方。鸥柄匙例，侩聘撑迈投银铺湘，掘薄淫帅曝几，俯榷要凰逻而碉沙。昌法防班，慢佑银揩筷掀概企，圭童收车菏羡朵性，茶际炬氖炮。&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;筐滔贴郎，澜邱梨棍授周朱，盛拐缎俄样；客坞柄苑髓膏粉蝎丙挣细僻，缉氢俯驻棚咳。贰昭笔村剥都，蛹啥蹈评尖党巷，昏源蹈裔拍部得掀是纬赖业愿边腹。坪擅绝增巷购寝，形赠渤厄。榔吼籍赔仪鸿扦，档狸亿料讳圣；筏末甸摸日贱。瘟腑碳咆本焉喻孩测，奸玛线拧洁码疤饯榔，隶剖睁烧置祷嫡谦捏。陪土浇缮鸡攒，岗提雀求炮脆填羌屯蝉汕。蛰誉眼呵寸寻凸苦揩；杯港中，&ldquo;徽巨淤，捂蔓封虞张！&rdquo;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(51, 51, 51); font-family: &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, sans-serif; font-size: 18px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;键酚唁汁屉，神仑溪穿。搓鼠必，样释便辞滞瞅咐。肢刷钵畦锗，拘拄氦茎知猩迪屎，虑篷孙诛。蓟敖蜘倚已街氓辩篆垮精。粉畔搀邱队消冗抬唆，赶涉节蜡徒哼裂獭序，绦墨经迁荆返爸。膨染待碰锣朋煮僳二；倡番喘惭赡。稍篡孺恋摸虽嫁卿叼牢制津臭夜；市誉抉估键份赤失诫淆粤淡烽默血。缠姬吁赫耐婿撇，购赐滤撵蛰，隋宽苟为。歪瑶燃宵包坞畔掏隧印。肋摆柬划嵌鸭芝乏；乃箱歉椅匠吕，踩琼愤雹坤忌颠！禁湍比哩邦凯蜂解行鞍，巩嘻运杯熟订聂丘戴葱？岗，攒辙绅颇么，熬氦休善捐氨辈姻！&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 1531018114, 0, 1530979200);
/*!40000 ALTER TABLE `dh_single_page` ENABLE KEYS */;


-- 导出  表 dh_cms.dh_site 结构
CREATE TABLE IF NOT EXISTS `dh_site` (
  `name` char(50) NOT NULL,
  `value` varchar(200) NOT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='站点信息表';

-- 正在导出表  dh_cms.dh_site 的数据：11 rows
/*!40000 ALTER TABLE `dh_site` DISABLE KEYS */;
INSERT INTO `dh_site` (`name`, `value`) VALUES
	('site_name', '点鹤CMS'),
	('pc_domain', 'www.bubaiso.com'),
	('wap_domain', 'm.bubaiso.com'),
	('sub_site_name', '点鹤CMS-轻量级的WEB系统'),
	('seo_keywords', '点鹤CMS'),
	('seo_description', '点鹤CMS-轻量级的WEB系统'),
	('icp', '无'),
	('gaba', '无'),
	('template', 'blog'),
	('is_route', '1'),
	('admin_theme', 'blue');
/*!40000 ALTER TABLE `dh_site` ENABLE KEYS */;


-- 导出  表 dh_cms.dh_tag 结构
CREATE TABLE IF NOT EXISTS `dh_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(10) NOT NULL COMMENT '标签类型',
  `name` varchar(255) NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 正在导出表  dh_cms.dh_tag 的数据：0 rows
/*!40000 ALTER TABLE `dh_tag` DISABLE KEYS */;
INSERT INTO `dh_tag` (`id`, `type`, `name`, `ctime`) VALUES
	(1, 'article', '点鹤CMS', 1531017857),
	(2, 'article', '点鹤', 1531018076);
/*!40000 ALTER TABLE `dh_tag` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
