/* PARA INICIALIZAR LA BD CON ALGUN DATO BASICO */


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL auto_increment,
  `parent_id` int(10) default NULL,
  `model` varchar(255) collate utf8_spanish_ci default NULL,
  `foreign_key` int(10) default NULL,
  `alias` varchar(255) collate utf8_spanish_ci default NULL,
  `lft` int(10) default NULL,
  `rght` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=531 ;

--
-- Volcar la base de datos para la tabla `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 1060),
(2, 1, NULL, NULL, 'Pages', 2, 15),
(3, 2, NULL, NULL, 'display', 3, 4),
(4, 2, NULL, NULL, 'add', 5, 6),
(5, 2, NULL, NULL, 'edit', 7, 8),
(6, 2, NULL, NULL, 'index', 9, 10),
(7, 2, NULL, NULL, 'view', 11, 12),
(8, 2, NULL, NULL, 'delete', 13, 14),
(9, 1, NULL, NULL, 'Mozos', 16, 29),
(10, 9, NULL, NULL, 'index', 17, 18),
(11, 9, NULL, NULL, 'view', 19, 20),
(12, 9, NULL, NULL, 'add', 21, 22),
(13, 9, NULL, NULL, 'edit', 23, 24),
(14, 9, NULL, NULL, 'delete', 25, 26),
(15, 9, NULL, NULL, 'mesas_abiertas', 27, 28),
(16, 1, NULL, NULL, 'Observaciones', 30, 41),
(17, 16, NULL, NULL, 'add', 31, 32),
(18, 16, NULL, NULL, 'edit', 33, 34),
(19, 16, NULL, NULL, 'index', 35, 36),
(20, 16, NULL, NULL, 'view', 37, 38),
(21, 16, NULL, NULL, 'delete', 39, 40),
(22, 1, NULL, NULL, 'Configs', 42, 55),
(23, 22, NULL, NULL, 'toggle_remito', 43, 44),
(24, 22, NULL, NULL, 'add', 45, 46),
(25, 22, NULL, NULL, 'edit', 47, 48),
(26, 22, NULL, NULL, 'index', 49, 50),
(27, 22, NULL, NULL, 'view', 51, 52),
(28, 22, NULL, NULL, 'delete', 53, 54),
(29, 1, NULL, NULL, 'Reservas', 56, 67),
(30, 29, NULL, NULL, 'index', 57, 58),
(31, 29, NULL, NULL, 'view', 59, 60),
(32, 29, NULL, NULL, 'add', 61, 62),
(33, 29, NULL, NULL, 'edit', 63, 64),
(34, 29, NULL, NULL, 'delete', 65, 66),
(35, 1, NULL, NULL, 'Sabores', 68, 79),
(36, 35, NULL, NULL, 'index', 69, 70),
(37, 35, NULL, NULL, 'view', 71, 72),
(38, 35, NULL, NULL, 'add', 73, 74),
(39, 35, NULL, NULL, 'edit', 75, 76),
(40, 35, NULL, NULL, 'delete', 77, 78),
(41, 1, NULL, NULL, 'ObservacionComandas', 80, 91),
(42, 41, NULL, NULL, 'add', 81, 82),
(43, 41, NULL, NULL, 'edit', 83, 84),
(44, 41, NULL, NULL, 'index', 85, 86),
(45, 41, NULL, NULL, 'view', 87, 88),
(46, 41, NULL, NULL, 'delete', 89, 90),
(47, 1, NULL, NULL, 'Categorias', 92, 111),
(48, 47, NULL, NULL, 'index', 93, 94),
(49, 47, NULL, NULL, 'reordenar', 95, 96),
(50, 47, NULL, NULL, 'view', 97, 98),
(51, 47, NULL, NULL, 'recover', 99, 100),
(52, 47, NULL, NULL, 'verify', 101, 102),
(53, 47, NULL, NULL, 'edit', 103, 104),
(54, 47, NULL, NULL, 'delete', 105, 106),
(55, 47, NULL, NULL, 'listar', 107, 108),
(56, 47, NULL, NULL, 'add', 109, 110),
(57, 1, NULL, NULL, 'TipoFacturas', 112, 133),
(58, 57, NULL, NULL, 'index', 113, 114),
(59, 57, NULL, NULL, 'view', 115, 116),
(60, 57, NULL, NULL, 'add', 117, 118),
(61, 57, NULL, NULL, 'edit', 119, 120),
(62, 57, NULL, NULL, 'delete', 121, 122),
(63, 57, NULL, NULL, 'admin_index', 123, 124),
(64, 57, NULL, NULL, 'admin_view', 125, 126),
(65, 57, NULL, NULL, 'admin_add', 127, 128),
(66, 57, NULL, NULL, 'admin_edit', 129, 130),
(67, 57, NULL, NULL, 'admin_delete', 131, 132),
(68, 1, NULL, NULL, 'Aclprep', 134, 161),
(69, 68, NULL, NULL, 'buildAcos', 135, 136),
(70, 68, NULL, NULL, 'buildAros', 137, 138),
(71, 68, NULL, NULL, 'assignPermissions', 139, 140),
(72, 68, NULL, NULL, 'assignPermissions1Dot6', 141, 142),
(73, 68, NULL, NULL, 'assignPermissions1Dot6Dot2', 143, 144),
(74, 68, NULL, NULL, 'assignPermissions1Dot6Dot3', 145, 146),
(75, 68, NULL, NULL, 'assignPermissions1Dot6Dot4', 147, 148),
(76, 68, NULL, NULL, 'checkPermissions', 149, 150),
(77, 68, NULL, NULL, 'add', 151, 152),
(78, 68, NULL, NULL, 'edit', 153, 154),
(79, 68, NULL, NULL, 'index', 155, 156),
(80, 68, NULL, NULL, 'view', 157, 158),
(81, 68, NULL, NULL, 'delete', 159, 160),
(82, 1, NULL, NULL, 'TipoDocumentos', 162, 173),
(83, 82, NULL, NULL, 'index', 163, 164),
(84, 82, NULL, NULL, 'view', 165, 166),
(85, 82, NULL, NULL, 'add', 167, 168),
(86, 82, NULL, NULL, 'edit', 169, 170),
(87, 82, NULL, NULL, 'delete', 171, 172),
(88, 1, NULL, NULL, 'Restaurantes', 174, 185),
(89, 88, NULL, NULL, 'index', 175, 176),
(90, 88, NULL, NULL, 'view', 177, 178),
(91, 88, NULL, NULL, 'add', 179, 180),
(92, 88, NULL, NULL, 'edit', 181, 182),
(93, 88, NULL, NULL, 'delete', 183, 184),
(94, 1, NULL, NULL, 'Egresos', 186, 199),
(95, 94, NULL, NULL, 'index', 187, 188),
(96, 94, NULL, NULL, 'ajax_agregar_gasto', 189, 190),
(97, 94, NULL, NULL, 'view', 191, 192),
(98, 94, NULL, NULL, 'add', 193, 194),
(99, 94, NULL, NULL, 'edit', 195, 196),
(100, 94, NULL, NULL, 'delete', 197, 198),
(101, 1, NULL, NULL, 'Comandas', 200, 213),
(102, 101, NULL, NULL, 'add', 201, 202),
(103, 101, NULL, NULL, 'index', 203, 204),
(104, 101, NULL, NULL, 'imprimir', 205, 206),
(105, 101, NULL, NULL, 'edit', 207, 208),
(106, 101, NULL, NULL, 'view', 209, 210),
(107, 101, NULL, NULL, 'delete', 211, 212),
(108, 1, NULL, NULL, 'DetalleSabores', 214, 225),
(109, 108, NULL, NULL, 'add', 215, 216),
(110, 108, NULL, NULL, 'edit', 217, 218),
(111, 108, NULL, NULL, 'index', 219, 220),
(112, 108, NULL, NULL, 'view', 221, 222),
(113, 108, NULL, NULL, 'delete', 223, 224),
(114, 1, NULL, NULL, 'Users', 226, 253),
(115, 114, NULL, NULL, 'index', 227, 228),
(116, 114, NULL, NULL, 'listar_x_nombre', 229, 230),
(117, 114, NULL, NULL, 'view', 231, 232),
(118, 114, NULL, NULL, 'add', 233, 234),
(119, 114, NULL, NULL, 'edit', 235, 236),
(120, 114, NULL, NULL, 'delete', 237, 238),
(121, 114, NULL, NULL, 'login', 239, 240),
(122, 114, NULL, NULL, 'logout', 241, 242),
(123, 114, NULL, NULL, 'self_user_edit', 243, 244),
(124, 114, NULL, NULL, 'cambiar_password', 245, 246),
(125, 114, NULL, NULL, 'verificar', 247, 248),
(126, 114, NULL, NULL, 'arreglar', 249, 250),
(127, 114, NULL, NULL, 'listadoUsuarios', 251, 252),
(128, 1, NULL, NULL, 'Comanderas', 254, 265),
(129, 128, NULL, NULL, 'index', 255, 256),
(130, 128, NULL, NULL, 'view', 257, 258),
(131, 128, NULL, NULL, 'add', 259, 260),
(132, 128, NULL, NULL, 'edit', 261, 262),
(133, 128, NULL, NULL, 'delete', 263, 264),
(134, 1, NULL, NULL, 'Pagos', 266, 277),
(135, 134, NULL, NULL, 'index', 267, 268),
(136, 134, NULL, NULL, 'view', 269, 270),
(137, 134, NULL, NULL, 'add', 271, 272),
(138, 134, NULL, NULL, 'edit', 273, 274),
(139, 134, NULL, NULL, 'delete', 275, 276),
(140, 1, NULL, NULL, 'IvaResponsabilidades', 278, 289),
(141, 140, NULL, NULL, 'index', 279, 280),
(142, 140, NULL, NULL, 'view', 281, 282),
(143, 140, NULL, NULL, 'add', 283, 284),
(144, 140, NULL, NULL, 'edit', 285, 286),
(145, 140, NULL, NULL, 'delete', 287, 288),
(146, 1, NULL, NULL, 'Descuentos', 290, 301),
(147, 146, NULL, NULL, 'index', 291, 292),
(148, 146, NULL, NULL, 'view', 293, 294),
(149, 146, NULL, NULL, 'add', 295, 296),
(150, 146, NULL, NULL, 'edit', 297, 298),
(151, 146, NULL, NULL, 'delete', 299, 300),
(152, 1, NULL, NULL, 'ConfigCategories', 302, 313),
(153, 152, NULL, NULL, 'add', 303, 304),
(154, 152, NULL, NULL, 'edit', 305, 306),
(155, 152, NULL, NULL, 'index', 307, 308),
(156, 152, NULL, NULL, 'view', 309, 310),
(157, 152, NULL, NULL, 'delete', 311, 312),
(158, 1, NULL, NULL, 'DetalleComandas', 314, 329),
(159, 158, NULL, NULL, 'index', 315, 316),
(160, 158, NULL, NULL, 'prueba', 317, 318),
(161, 158, NULL, NULL, 'view', 319, 320),
(162, 158, NULL, NULL, 'sacarProductos', 321, 322),
(163, 158, NULL, NULL, 'add', 323, 324),
(164, 158, NULL, NULL, 'edit', 325, 326),
(165, 158, NULL, NULL, 'delete', 327, 328),
(166, 1, NULL, NULL, 'ProductosPreciosFuturos', 330, 341),
(167, 166, NULL, NULL, 'index', 331, 332),
(168, 166, NULL, NULL, 'add', 333, 334),
(169, 166, NULL, NULL, 'edit', 335, 336),
(170, 166, NULL, NULL, 'view', 337, 338),
(171, 166, NULL, NULL, 'delete', 339, 340),
(172, 1, NULL, NULL, 'TipoDePagos', 342, 353),
(173, 172, NULL, NULL, 'index', 343, 344),
(174, 172, NULL, NULL, 'view', 345, 346),
(175, 172, NULL, NULL, 'edit', 347, 348),
(176, 172, NULL, NULL, 'delete', 349, 350),
(177, 172, NULL, NULL, 'add', 351, 352),
(178, 1, NULL, NULL, 'Productos', 354, 375),
(179, 178, NULL, NULL, 'index', 355, 356),
(180, 178, NULL, NULL, 'view', 357, 358),
(181, 178, NULL, NULL, 'buscar_por_nombre', 359, 360),
(182, 178, NULL, NULL, 'add', 361, 362),
(183, 178, NULL, NULL, 'edit', 363, 364),
(184, 178, NULL, NULL, 'delete', 365, 366),
(185, 178, NULL, NULL, 'buscarProductos', 367, 368),
(186, 178, NULL, NULL, 'actualizarPreciosFuturos', 369, 370),
(187, 178, NULL, NULL, 'sinpreciosfuturos', 371, 372),
(188, 178, NULL, NULL, 'update', 373, 374),
(189, 1, NULL, NULL, 'Mesas', 376, 405),
(190, 189, NULL, NULL, 'index', 377, 378),
(191, 189, NULL, NULL, 'view', 379, 380),
(192, 189, NULL, NULL, 'ticket_view', 381, 382),
(193, 189, NULL, NULL, 'cerrarMesa', 383, 384),
(194, 189, NULL, NULL, 'imprimirTicket', 385, 386),
(195, 189, NULL, NULL, 'abrirMesa', 387, 388),
(196, 189, NULL, NULL, 'add', 389, 390),
(197, 189, NULL, NULL, 'ajax_edit', 391, 392),
(198, 189, NULL, NULL, 'edit', 393, 394),
(199, 189, NULL, NULL, 'delete', 395, 396),
(200, 189, NULL, NULL, 'cerradas', 397, 398),
(201, 189, NULL, NULL, 'abiertas', 399, 400),
(202, 189, NULL, NULL, 'reabrir', 401, 402),
(203, 189, NULL, NULL, 'addClienteToMesa', 403, 404),
(204, 1, NULL, NULL, 'Clientes', 406, 427),
(205, 204, NULL, NULL, 'index', 407, 408),
(206, 204, NULL, NULL, 'view', 409, 410),
(207, 204, NULL, NULL, 'add', 411, 412),
(208, 204, NULL, NULL, 'addFacturaA', 413, 414),
(209, 204, NULL, NULL, 'edit', 415, 416),
(210, 204, NULL, NULL, 'delete', 417, 418),
(211, 204, NULL, NULL, 'ajax_buscador', 419, 420),
(212, 204, NULL, NULL, 'jqm_clientes', 421, 422),
(213, 204, NULL, NULL, 'ajax_clientes_factura_a', 423, 424),
(214, 204, NULL, NULL, 'ajax_clientes_con_descuento', 425, 426),
(215, 1, NULL, NULL, 'Account', 428, 515),
(216, 215, NULL, NULL, 'TipoImpuestos', 429, 440),
(217, 216, NULL, NULL, 'index', 430, 431),
(218, 216, NULL, NULL, 'view', 432, 433),
(219, 216, NULL, NULL, 'add', 434, 435),
(220, 216, NULL, NULL, 'edit', 436, 437),
(221, 216, NULL, NULL, 'delete', 438, 439),
(222, 215, NULL, NULL, 'Account', 441, 514),
(223, 222, NULL, NULL, 'index', 442, 443),
(224, 222, NULL, NULL, 'arqueo', 444, 445),
(225, 222, NULL, NULL, 'success', 446, 447),
(226, 222, NULL, NULL, 'failure', 448, 449),
(227, 222, NULL, NULL, 'add', 450, 451),
(228, 222, NULL, NULL, 'edit', 452, 453),
(229, 222, NULL, NULL, 'view', 454, 455),
(230, 222, NULL, NULL, 'delete', 456, 457),
(231, 222, NULL, NULL, 'Proveedores', 458, 469),
(232, 231, NULL, NULL, 'index', 459, 460),
(233, 231, NULL, NULL, 'view', 461, 462),
(234, 231, NULL, NULL, 'add', 463, 464),
(235, 231, NULL, NULL, 'edit', 465, 466),
(236, 231, NULL, NULL, 'delete', 467, 468),
(237, 222, NULL, NULL, 'Gastos', 470, 485),
(238, 237, NULL, NULL, 'index', 471, 472),
(239, 237, NULL, NULL, 'view', 473, 474),
(240, 237, NULL, NULL, 'add', 475, 476),
(241, 237, NULL, NULL, 'edit', 477, 478),
(242, 237, NULL, NULL, 'delete', 479, 480),
(243, 237, NULL, NULL, 'success', 481, 482),
(244, 237, NULL, NULL, 'failure', 483, 484),
(245, 222, NULL, NULL, 'GastosTipoImpuestos', 486, 497),
(246, 245, NULL, NULL, 'index', 487, 488),
(247, 245, NULL, NULL, 'view', 489, 490),
(248, 245, NULL, NULL, 'add', 491, 492),
(249, 245, NULL, NULL, 'edit', 493, 494),
(250, 245, NULL, NULL, 'delete', 495, 496),
(251, 222, NULL, NULL, 'Vales', 498, 513),
(252, 251, NULL, NULL, 'index', 499, 500),
(253, 251, NULL, NULL, 'add', 501, 502),
(254, 251, NULL, NULL, 'edit', 503, 504),
(255, 251, NULL, NULL, 'delete', 505, 506),
(256, 251, NULL, NULL, 'success', 507, 508),
(257, 251, NULL, NULL, 'failure', 509, 510),
(258, 251, NULL, NULL, 'view', 511, 512),
(259, 1, NULL, NULL, 'Acl', 516, 631),
(260, 259, NULL, NULL, 'AclAros', 517, 540),
(261, 260, NULL, NULL, 'load', 518, 519),
(262, 260, NULL, NULL, 'delete', 520, 521),
(263, 260, NULL, NULL, 'children', 522, 523),
(264, 260, NULL, NULL, 'add', 524, 525),
(265, 260, NULL, NULL, 'update', 526, 527),
(266, 260, NULL, NULL, 'test', 528, 529),
(267, 260, NULL, NULL, 'success', 530, 531),
(268, 260, NULL, NULL, 'failure', 532, 533),
(269, 260, NULL, NULL, 'edit', 534, 535),
(270, 260, NULL, NULL, 'index', 536, 537),
(271, 260, NULL, NULL, 'view', 538, 539),
(272, 259, NULL, NULL, 'AclAcos', 541, 562),
(273, 272, NULL, NULL, 'load', 542, 543),
(274, 272, NULL, NULL, 'delete', 544, 545),
(275, 272, NULL, NULL, 'children', 546, 547),
(276, 272, NULL, NULL, 'add', 548, 549),
(277, 272, NULL, NULL, 'update', 550, 551),
(278, 272, NULL, NULL, 'success', 552, 553),
(279, 272, NULL, NULL, 'failure', 554, 555),
(280, 272, NULL, NULL, 'edit', 556, 557),
(281, 272, NULL, NULL, 'index', 558, 559),
(282, 272, NULL, NULL, 'view', 560, 561),
(283, 259, NULL, NULL, 'Acl', 563, 630),
(284, 283, NULL, NULL, 'admin_index', 564, 565),
(285, 283, NULL, NULL, 'admin_aros', 566, 567),
(286, 283, NULL, NULL, 'admin_acos', 568, 569),
(287, 283, NULL, NULL, 'admin_permissions', 570, 571),
(288, 283, NULL, NULL, 'admin_tree', 572, 573),
(289, 283, NULL, NULL, 'success', 574, 575),
(290, 283, NULL, NULL, 'failure', 576, 577),
(291, 283, NULL, NULL, 'add', 578, 579),
(292, 283, NULL, NULL, 'edit', 580, 581),
(293, 283, NULL, NULL, 'index', 582, 583),
(294, 283, NULL, NULL, 'view', 584, 585),
(295, 283, NULL, NULL, 'delete', 586, 587),
(296, 283, NULL, NULL, 'AclPermissions', 588, 613),
(297, 296, NULL, NULL, 'exists', 589, 590),
(298, 296, NULL, NULL, 'create', 591, 592),
(299, 296, NULL, NULL, 'aros', 593, 594),
(300, 296, NULL, NULL, 'acos', 595, 596),
(301, 296, NULL, NULL, 'revoke', 597, 598),
(302, 296, NULL, NULL, 'success', 599, 600),
(303, 296, NULL, NULL, 'failure', 601, 602),
(304, 296, NULL, NULL, 'add', 603, 604),
(305, 296, NULL, NULL, 'edit', 605, 606),
(306, 296, NULL, NULL, 'index', 607, 608),
(307, 296, NULL, NULL, 'view', 609, 610),
(308, 296, NULL, NULL, 'delete', 611, 612),
(309, 283, NULL, NULL, 'AclScripts', 614, 629),
(310, 309, NULL, NULL, 'success', 615, 616),
(311, 309, NULL, NULL, 'failure', 617, 618),
(312, 309, NULL, NULL, 'add', 619, 620),
(313, 309, NULL, NULL, 'edit', 621, 622),
(314, 309, NULL, NULL, 'index', 623, 624),
(315, 309, NULL, NULL, 'view', 625, 626),
(316, 309, NULL, NULL, 'delete', 627, 628),
(317, 1, NULL, NULL, 'Adition', 632, 741),
(318, 317, NULL, NULL, 'Adition', 633, 740),
(319, 318, NULL, NULL, 'home', 634, 635),
(320, 318, NULL, NULL, 'abrirMesa', 636, 637),
(321, 318, NULL, NULL, 'adicionar', 638, 639),
(322, 318, NULL, NULL, 'cambiarMozo', 640, 641),
(323, 318, NULL, NULL, 'success', 642, 643),
(324, 318, NULL, NULL, 'failure', 644, 645),
(325, 318, NULL, NULL, 'add', 646, 647),
(326, 318, NULL, NULL, 'edit', 648, 649),
(327, 318, NULL, NULL, 'index', 650, 651),
(328, 318, NULL, NULL, 'view', 652, 653),
(329, 318, NULL, NULL, 'delete', 654, 655),
(330, 318, NULL, NULL, 'Cashier', 656, 739),
(331, 330, NULL, NULL, 'reiniciar', 657, 658),
(332, 330, NULL, NULL, 'apagar', 659, 660),
(333, 330, NULL, NULL, 'cierre_z', 661, 662),
(334, 330, NULL, NULL, 'cierre_x', 663, 664),
(335, 330, NULL, NULL, 'nota_credito', 665, 666),
(336, 330, NULL, NULL, 'vaciar_cola_impresion_fiscal', 667, 668),
(337, 330, NULL, NULL, 'listar_dispositivos', 669, 670),
(338, 330, NULL, NULL, 'print_dnf', 671, 672),
(339, 330, NULL, NULL, 'cobrar', 673, 674),
(340, 330, NULL, NULL, 'ajax_mesas_x_cobrar', 675, 676),
(341, 330, NULL, NULL, 'mesas_abiertas', 677, 678),
(342, 330, NULL, NULL, 'ultimas_cobradas', 679, 680),
(343, 330, NULL, NULL, 'activar_webcam', 681, 682),
(344, 330, NULL, NULL, 'success', 683, 684),
(345, 330, NULL, NULL, 'failure', 685, 686),
(346, 330, NULL, NULL, 'add', 687, 688),
(347, 330, NULL, NULL, 'edit', 689, 690),
(348, 330, NULL, NULL, 'index', 691, 692),
(349, 330, NULL, NULL, 'view', 693, 694),
(350, 330, NULL, NULL, 'delete', 695, 696),
(351, 330, NULL, NULL, 'Cashier', 697, 738),
(352, 351, NULL, NULL, 'reiniciar', 698, 699),
(353, 351, NULL, NULL, 'apagar', 700, 701),
(354, 351, NULL, NULL, 'cierre_z', 702, 703),
(355, 351, NULL, NULL, 'cierre_x', 704, 705),
(356, 351, NULL, NULL, 'nota_credito', 706, 707),
(357, 351, NULL, NULL, 'vaciar_cola_impresion_fiscal', 708, 709),
(358, 351, NULL, NULL, 'listar_dispositivos', 710, 711),
(359, 351, NULL, NULL, 'print_dnf', 712, 713),
(360, 351, NULL, NULL, 'cobrar', 714, 715),
(361, 351, NULL, NULL, 'ajax_mesas_x_cobrar', 716, 717),
(362, 351, NULL, NULL, 'mesas_abiertas', 718, 719),
(363, 351, NULL, NULL, 'ultimas_cobradas', 720, 721),
(364, 351, NULL, NULL, 'activar_webcam', 722, 723),
(365, 351, NULL, NULL, 'success', 724, 725),
(366, 351, NULL, NULL, 'failure', 726, 727),
(367, 351, NULL, NULL, 'add', 728, 729),
(368, 351, NULL, NULL, 'edit', 730, 731),
(369, 351, NULL, NULL, 'index', 732, 733),
(370, 351, NULL, NULL, 'view', 734, 735),
(371, 351, NULL, NULL, 'delete', 736, 737),
(372, 1, NULL, NULL, 'Inventory', 742, 795),
(373, 372, NULL, NULL, 'Counts', 743, 756),
(374, 373, NULL, NULL, 'listar_faltantes_para_imprimir', 744, 745),
(375, 373, NULL, NULL, 'add', 746, 747),
(376, 373, NULL, NULL, 'edit', 748, 749),
(377, 373, NULL, NULL, 'index', 750, 751),
(378, 373, NULL, NULL, 'view', 752, 753),
(379, 373, NULL, NULL, 'delete', 754, 755),
(380, 372, NULL, NULL, 'Inventory', 757, 794),
(381, 380, NULL, NULL, 'index', 758, 759),
(382, 380, NULL, NULL, 'add', 760, 761),
(383, 380, NULL, NULL, 'edit', 762, 763),
(384, 380, NULL, NULL, 'view', 764, 765),
(385, 380, NULL, NULL, 'delete', 766, 767),
(386, 380, NULL, NULL, 'Products', 768, 781),
(387, 386, NULL, NULL, 'index', 769, 770),
(388, 386, NULL, NULL, 'update', 771, 772),
(389, 386, NULL, NULL, 'add', 773, 774),
(390, 386, NULL, NULL, 'view', 775, 776),
(391, 386, NULL, NULL, 'edit', 777, 778),
(392, 386, NULL, NULL, 'delete', 779, 780),
(393, 380, NULL, NULL, 'Categories', 782, 793),
(394, 393, NULL, NULL, 'add', 783, 784),
(395, 393, NULL, NULL, 'edit', 785, 786),
(396, 393, NULL, NULL, 'index', 787, 788),
(397, 393, NULL, NULL, 'view', 789, 790),
(398, 393, NULL, NULL, 'delete', 791, 792),
(399, 1, NULL, NULL, 'New Cashier', 796, 829),
(400, 399, NULL, NULL, 'Cashiers', 797, 828),
(401, 400, NULL, NULL, 'mesas_abiertas', 798, 799),
(402, 400, NULL, NULL, 'reiniciar', 800, 801),
(403, 400, NULL, NULL, 'cierre_x', 802, 803),
(404, 400, NULL, NULL, 'cierre_z', 804, 805),
(405, 400, NULL, NULL, 'vaciar_cola_impresion_fiscal', 806, 807),
(406, 400, NULL, NULL, 'print_dnf', 808, 809),
(407, 400, NULL, NULL, 'cobrar', 810, 811),
(408, 400, NULL, NULL, 'activar_webcam', 812, 813),
(409, 400, NULL, NULL, 'success', 814, 815),
(410, 400, NULL, NULL, 'failure', 816, 817),
(411, 400, NULL, NULL, 'add', 818, 819),
(412, 400, NULL, NULL, 'edit', 820, 821),
(413, 400, NULL, NULL, 'index', 822, 823),
(414, 400, NULL, NULL, 'view', 824, 825),
(415, 400, NULL, NULL, 'delete', 826, 827),
(416, 1, NULL, NULL, 'Pquery', 830, 1007),
(417, 416, NULL, NULL, 'PqueryCategories', 831, 842),
(418, 417, NULL, NULL, 'add', 832, 833),
(419, 417, NULL, NULL, 'edit', 834, 835),
(420, 417, NULL, NULL, 'index', 836, 837),
(421, 417, NULL, NULL, 'view', 838, 839),
(422, 417, NULL, NULL, 'delete', 840, 841),
(423, 416, NULL, NULL, 'Stats', 843, 982),
(424, 423, NULL, NULL, 'year', 844, 845),
(425, 423, NULL, NULL, 'mesas_total', 846, 847),
(426, 423, NULL, NULL, 'mozos_total', 848, 849),
(427, 423, NULL, NULL, 'mesas_factura', 850, 851),
(428, 423, NULL, NULL, 'dia', 852, 853),
(429, 423, NULL, NULL, 'index', 854, 855),
(430, 423, NULL, NULL, 'mozos_mesas', 856, 857),
(431, 423, NULL, NULL, 'mozos_pagos', 858, 859),
(432, 423, NULL, NULL, 'mozos_productos', 860, 861),
(433, 423, NULL, NULL, 'mesas_ranking', 862, 863),
(434, 423, NULL, NULL, 'mesas_pago', 864, 865),
(435, 423, NULL, NULL, 'mesas_clientes', 866, 867),
(436, 423, NULL, NULL, 'cont_ingresos', 868, 869),
(437, 423, NULL, NULL, 'cont_caja', 870, 871),
(438, 423, NULL, NULL, 'prod_ranking', 872, 873),
(439, 423, NULL, NULL, 'prod_ingresos', 874, 875),
(440, 423, NULL, NULL, 'prod_pedidos', 876, 877),
(441, 423, NULL, NULL, 'prod_listado', 878, 879),
(442, 423, NULL, NULL, 'real_mesasabiertas', 880, 881),
(443, 423, NULL, NULL, 'real_comandas', 882, 883),
(444, 423, NULL, NULL, 'real_comensales', 884, 885),
(445, 423, NULL, NULL, 'real_mesasmozos', 886, 887),
(446, 423, NULL, NULL, 'success', 888, 889),
(447, 423, NULL, NULL, 'failure', 890, 891),
(448, 423, NULL, NULL, 'add', 892, 893),
(449, 423, NULL, NULL, 'edit', 894, 895),
(450, 423, NULL, NULL, 'view', 896, 897),
(451, 423, NULL, NULL, 'delete', 898, 899),
(452, 416, NULL, NULL, 'Queries', 983, 1006),
(453, 452, NULL, NULL, 'index', 984, 985),
(454, 452, NULL, NULL, 'view', 986, 987),
(455, 452, NULL, NULL, 'add', 988, 989),
(456, 452, NULL, NULL, 'edit', 990, 991),
(457, 452, NULL, NULL, 'delete', 992, 993),
(458, 452, NULL, NULL, 'descargar_queries', 994, 995),
(459, 452, NULL, NULL, 'contruye_excel', 996, 997),
(460, 452, NULL, NULL, 'get_columnas', 998, 999),
(461, 452, NULL, NULL, 'list_view', 1000, 1001),
(462, 452, NULL, NULL, 'success', 1002, 1003),
(463, 452, NULL, NULL, 'failure', 1004, 1005),
(464, 1, NULL, NULL, 'PqueryOLD', 1008, 1033),
(465, 464, NULL, NULL, 'Queries', 1009, 1032),
(466, 465, NULL, NULL, 'index', 1010, 1011),
(467, 465, NULL, NULL, 'view', 1012, 1013),
(468, 465, NULL, NULL, 'add', 1014, 1015),
(469, 465, NULL, NULL, 'edit', 1016, 1017),
(470, 465, NULL, NULL, 'delete', 1018, 1019),
(471, 465, NULL, NULL, 'descargar_queries', 1020, 1021),
(472, 465, NULL, NULL, 'contruye_excel', 1022, 1023),
(473, 465, NULL, NULL, 'get_columnas', 1024, 1025),
(474, 465, NULL, NULL, 'list_view', 1026, 1027),
(475, 465, NULL, NULL, 'success', 1028, 1029),
(476, 465, NULL, NULL, 'failure', 1030, 1031),
(477, 1, NULL, NULL, 'Robot', 1034, 1059),
(478, 477, NULL, NULL, 'Queries', 1035, 1058),
(479, 478, NULL, NULL, 'index', 1036, 1037),
(480, 478, NULL, NULL, 'view', 1038, 1039),
(481, 478, NULL, NULL, 'add', 1040, 1041),
(482, 478, NULL, NULL, 'edit', 1042, 1043),
(483, 478, NULL, NULL, 'delete', 1044, 1045),
(484, 478, NULL, NULL, 'descargar_queries', 1046, 1047),
(485, 478, NULL, NULL, 'contruye_excel', 1048, 1049),
(486, 478, NULL, NULL, 'get_columnas', 1050, 1051),
(487, 478, NULL, NULL, 'list_view', 1052, 1053),
(488, 478, NULL, NULL, 'success', 1054, 1055),
(489, 478, NULL, NULL, 'failure', 1056, 1057),
(490, 423, NULL, NULL, 'Stats', 900, 981),
(491, 490, NULL, NULL, 'year', 901, 902),
(492, 490, NULL, NULL, 'mesas_total', 903, 904),
(493, 490, NULL, NULL, 'mozos_total', 905, 906),
(494, 490, NULL, NULL, 'mesas_factura', 907, 908),
(495, 490, NULL, NULL, 'dia', 909, 910),
(496, 490, NULL, NULL, 'index', 911, 912),
(497, 490, NULL, NULL, 'mozos_mesas', 913, 914),
(498, 490, NULL, NULL, 'mozos_pagos', 915, 916),
(499, 490, NULL, NULL, 'mozos_productos', 917, 918),
(500, 490, NULL, NULL, 'mesas_ranking', 919, 920),
(501, 490, NULL, NULL, 'mesas_pago', 921, 922),
(502, 490, NULL, NULL, 'mesas_clientes', 923, 924),
(503, 490, NULL, NULL, 'cont_ingresos', 925, 926),
(504, 490, NULL, NULL, 'cont_caja', 927, 928),
(505, 490, NULL, NULL, 'prod_ranking', 929, 930),
(506, 490, NULL, NULL, 'prod_ingresos', 931, 932),
(507, 490, NULL, NULL, 'prod_pedidos', 933, 934),
(508, 490, NULL, NULL, 'prod_listado', 935, 936),
(509, 490, NULL, NULL, 'real_mesasabiertas', 937, 938),
(510, 490, NULL, NULL, 'real_comandas', 939, 940),
(511, 490, NULL, NULL, 'real_comensales', 941, 942),
(512, 490, NULL, NULL, 'real_mesasmozos', 943, 944),
(513, 490, NULL, NULL, 'success', 945, 946),
(514, 490, NULL, NULL, 'failure', 947, 948),
(515, 490, NULL, NULL, 'add', 949, 950),
(516, 490, NULL, NULL, 'edit', 951, 952),
(517, 490, NULL, NULL, 'view', 953, 954),
(518, 490, NULL, NULL, 'delete', 955, 956),
(519, 490, NULL, NULL, 'Queries', 957, 980),
(520, 519, NULL, NULL, 'index', 958, 959),
(521, 519, NULL, NULL, 'view', 960, 961),
(522, 519, NULL, NULL, 'add', 962, 963),
(523, 519, NULL, NULL, 'edit', 964, 965),
(524, 519, NULL, NULL, 'delete', 966, 967),
(525, 519, NULL, NULL, 'descargar_queries', 968, 969),
(526, 519, NULL, NULL, 'contruye_excel', 970, 971),
(527, 519, NULL, NULL, 'get_columnas', 972, 973),
(528, 519, NULL, NULL, 'list_view', 974, 975),
(529, 519, NULL, NULL, 'success', 976, 977),
(530, 519, NULL, NULL, 'failure', 978, 979);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL auto_increment,
  `parent_id` int(10) default NULL,
  `model` varchar(255) collate utf8_spanish_ci default NULL,
  `foreign_key` int(10) default NULL,
  `alias` varchar(255) collate utf8_spanish_ci default NULL,
  `lft` int(10) default NULL,
  `rght` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, '', NULL, 'User', 1, 8),
(2, 1, '', NULL, 'Gerente', 2, 7),
(3, 2, 'User', 1, 'admin', 3, 4),
(4, 2, 'User', 2, 'mozo', 5, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL auto_increment,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) collate utf8_spanish_ci NOT NULL default '0',
  `_read` varchar(2) collate utf8_spanish_ci NOT NULL default '0',
  `_update` varchar(2) collate utf8_spanish_ci NOT NULL default '0',
  `_delete` varchar(2) collate utf8_spanish_ci NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cake_sessions`
--

CREATE TABLE IF NOT EXISTS `cake_sessions` (
  `id` varchar(255) NOT NULL default '',
  `data` text,
  `expires` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `parent_id` int(10) unsigned default NULL,
  `lft` int(10) unsigned default NULL,
  `rght` int(10) unsigned default NULL,
  `name` varchar(20) collate utf8_spanish_ci NOT NULL,
  `description` text collate utf8_spanish_ci NOT NULL,
  `image_url` varchar(200) collate utf8_spanish_ci default NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  `deleted_date` timestamp NULL default NULL,
  `deleted` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `parent` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `parent_id`, `lft`, `rght`, `name`, `description`, `image_url`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
(1, NULL, 1, 8, '/', '', '', '2012-11-28 22:57:10', '2012-11-28 22:57:10', NULL, 0),
(2, 1, 2, 3, 'Guarnicion', '', 'french_fries_icon.png', '2013-05-17 13:49:56', '2013-05-17 13:46:57', NULL, 0),
(3, 1, 4, 5, 'Bebidas', '', 'Pepsi_Classic_128.png', '2014-04-02 06:49:47', '2014-04-02 06:49:47', NULL, 0),
(4, 1, 6, 7, 'Hamburguesas', '', 'hamburger_128.png', '2014-04-02 06:53:54', '2014-04-02 06:53:54', NULL, 0);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned default NULL,
  `codigo` int(11) default NULL,
  `mail` varchar(110) collate utf8_spanish_ci default NULL,
  `telefono` varchar(30) collate utf8_spanish_ci default NULL,
  `descuento_id` int(10) unsigned default '0',
  `tipofactura` char(1) collate utf8_spanish_ci default NULL,
  `imprime_ticket` tinyint(1) default '1',
  `nombre` varchar(110) collate utf8_spanish_ci default NULL,
  `nrodocumento` varchar(11) collate utf8_spanish_ci default NULL,
  `tipodocumento` varchar(1) collate utf8_spanish_ci default NULL,
  `tipo_documento_id` int(11) default NULL,
  `domicilio` varchar(110) collate utf8_spanish_ci default NULL,
  `responsabilidad_iva` varchar(1) collate utf8_spanish_ci default NULL COMMENT 'ver el listado de posibilidades de CHARs para la responsabilidad del IVA, se pude ver en el codigo fuente, pero es casi un standar',
  `iva_responsabilidad_id` int(11) default NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

INSERT INTO `clientes` (`id`, `user_id`, `codigo`, `mail`, `telefono`, `descuento_id`, `tipofactura`, `imprime_ticket`, `nombre`, `nrodocumento`, `tipodocumento`, `tipo_documento_id`, `domicilio`, `responsabilidad_iva`, `iva_responsabilidad_id`, `created`, `modified`) VALUES
(1, NULL, NULL, NULL, NULL, 0, 'A', 1, 'EXAMPLE Google Arg. SRL', '33709585229', NULL, 1, NULL, NULL, 1, '2013-05-17 13:52:17', '2013-05-17 13:52:17');

--
-- Volcar la base de datos para la tabla `clientes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comandas`
--

CREATE TABLE IF NOT EXISTS `comandas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `mesa_id` int(11) NOT NULL,
  `prioridad` tinyint(4) NOT NULL,
  `impresa` timestamp NULL default NULL,
  `created` timestamp NULL default NULL,
  `observacion` text collate utf8_spanish_ci,
  PRIMARY KEY  (`id`),
  KEY `mesa_id` (`mesa_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `comandas`
--

INSERT INTO `comandas` (`id`, `mesa_id`, `prioridad`, `impresa`, `created`, `observacion`) VALUES
(1, 1, 0, NULL, '2012-11-28 23:07:32', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanderas`
--

CREATE TABLE IF NOT EXISTS `comanderas` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) collate utf8_spanish_ci NOT NULL,
  `description` varchar(100) collate utf8_spanish_ci NOT NULL,
  `path` varchar(64) collate utf8_spanish_ci NOT NULL,
  `imprime_ticket` tinyint(1) NOT NULL default '0' COMMENT 'me dice si imprime o no tickets factura',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `comanderas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comensales`
--

CREATE TABLE IF NOT EXISTS `comensales` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cant_mayores` tinyint(4) NOT NULL,
  `cant_menores` tinyint(4) NOT NULL,
  `cant_bebes` tinyint(4) NOT NULL,
  `mesa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `comensales`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `config_category_id` int(10) unsigned NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `description` text,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=28 ;

--
-- Volcar la base de datos para la tabla `configs`
--

INSERT INTO `configs` (`id`, `config_category_id`, `key`, `value`, `description`, `created`, `modified`) VALUES
(1, 1, 'imprimePrimeroRemito', '1', 'Esta variable sirve para imprimir siempre un comprobante de consumicion antes de imprimir el ticket los valores posibles son 1 o 0 (para imprimir directamente la factura)', NULL, '2012-01-13 22:12:39'),
(2, 2, 'name', 'Nombre', 'Generalmente utilizado para las impresiones extra como remitos e informes', NULL, '2012-11-28 21:36:07'),
(3, 2, 'razon_social', '', '', NULL, NULL),
(4, 2, 'cuit', '', '', NULL, NULL),
(5, 2, 'ib', '', 'ingresos brutos', NULL, NULL),
(6, 2, 'iva_resp', '', '', NULL, NULL),
(7, 3, 'modelo', 'hasar_441', '', NULL, NULL),
(8, 4, 'usarCajero', '1', '', NULL, NULL),
(9, 1, 'tituloMesa', 'Mesa', '', NULL, '2012-11-28 21:36:24'),
(10, 1, 'tituloMozo', 'Mozo', '', NULL, '2012-11-28 21:36:46'),
(11, 4, 'cantidadCubiertosObligatorio', '0', '', NULL, '2012-11-28 21:36:59'),
(12, 3, 'tempFuente', '/tmp/fuente', '', NULL, NULL),
(13, 3, 'tempDest', '/tmp/dest', '', NULL, NULL),
(14, 3, 'TempImpfiscal', '/tmp/impfiscal', '', NULL, NULL),
(15, 5, 'debug', '0', '', NULL, '2012-11-28 22:22:06'),
(16, 6, 'descuento_maximo', '15', 'máximo porcentaje de descuento que puede hacer un mozo', NULL, NULL),
(17, 7, 'corte_del_dia', '6', 'Es el horario en el que se va a tomar como corte del dia. Funcionara para el arqueo de caja, recuento de mesas. Por ejemplo, si se dice que el corte del dia es a las 6, quiere decir que, lo que vendi hasta las 6AM pertenecen al dia anterior. O sea, si es sabado y pasan las 12 am, hasta las 6 de la madrugada del domingo, se dirá que lo vendido pertenece al día sabado.', NULL, NULL),
(18, 3, 'encoding', '', 'encoding para las impresoras, de esta forma saldrán los acentos. Lo que no funciona es la "Ñ" mayúscula', NULL, '2011-11-15 20:23:03'),
(19, 4, 'reload_interval', '3700', 'valor en milisegundos de actualizacion de nuevas mesas', NULL, '2012-11-28 21:37:22'),
(20, 4, 'reload_interval_timeout', '60000', 'valor en milisegundos que debe esperar el ajax para actualizar las mesas. Si el ajax no se resuelve. entonces se termina a la fuerza.', NULL, '2012-11-28 21:37:29'),
(21, 4, 'jqm_page_transition', '1', 'activar animaciones\r\n', NULL, '2012-11-28 21:37:44'),
(22, 3, 'server', 'auto', '', NULL, '2012-11-28 22:19:51'),
(23, 3, 'nombre', 'fiscalfile', 'nombre de la impresora CUPS, es la impresora fiscal que para CUPS será una impresora que imprima "raw" en una carpeta particular donde estará leyendo el spooler', NULL, '2011-11-15 21:33:01'),
(24, 1, 'prueba', '1111111', '', '2011-11-04 09:21:31', '2011-11-04 09:21:31'),
(25, 2, 'valorCubierto', '0', '', '2011-11-06 17:55:21', '2011-11-15 20:10:11'),
(26, 2, 'mail', 'info@mail.com.ar', '', '2011-11-22 20:13:01', '2012-11-25 00:02:17'),
(27, 4, 'preTicketHeader', '            COMPROBANTE DE CONSUMICION', '', '2011-11-22 20:13:38', '2011-11-22 20:13:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_categories`
--

CREATE TABLE IF NOT EXISTS `config_categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `config_categories`
--

INSERT INTO `config_categories` (`id`, `name`) VALUES
(1, 'Mesa'),
(2, 'Restaurante'),
(3, 'ImpresoraFiscal'),
(4, 'Adicion'),
(5, ''),
(6, 'Mozo'),
(7, 'Horario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE IF NOT EXISTS `descuentos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(20) collate utf8_spanish_ci NOT NULL,
  `description` text collate utf8_spanish_ci,
  `porcentaje` float NOT NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `descuentos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_comandas`
--

CREATE TABLE IF NOT EXISTS `detalle_comandas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `producto_id` int(10) unsigned NOT NULL,
  `cant` tinyint(4) NOT NULL,
  `cant_eliminada` tinyint(4) NOT NULL default '0',
  `comanda_id` int(11) unsigned NOT NULL,
  `observacion` text collate utf8_spanish_ci,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  `es_entrada` tinyint(4) default '0',
  PRIMARY KEY  (`id`),
  KEY `mesa_id_2` (`comanda_id`),
  KEY `producto_id` (`producto_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `detalle_comandas`
--

INSERT INTO `detalle_comandas` (`id`, `producto_id`, `cant`, `cant_eliminada`, `comanda_id`, `observacion`, `created`, `modified`, `es_entrada`) VALUES
(1, 1, 1, 0, 1, '', '2012-11-28 23:07:32', '2012-11-28 23:07:32', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_sabores`
--

CREATE TABLE IF NOT EXISTS `detalle_sabores` (
  `id` int(11) NOT NULL auto_increment,
  `detalle_comanda_id` int(11) NOT NULL,
  `sabor_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `detalle_sabores`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE IF NOT EXISTS `egresos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) collate utf8_spanish_ci NOT NULL,
  `tipo_factura_id` int(11) default NULL,
  `iva` float(10,2) default '0.00',
  `iibb` float(10,2) default '0.00',
  `otros` float(10,2) default '0.00',
  `total` float(10,2) NOT NULL default '0.00',
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `egresos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE IF NOT EXISTS `gastos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(200) collate utf8_spanish_ci NOT NULL,
  `importe` float(10,2) NOT NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `gastos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_precios`
--

CREATE TABLE IF NOT EXISTS `historico_precios` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `precio` float NOT NULL,
  `producto_id` int(11) NOT NULL,
  `created` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM ;

--
-- Volcar la base de datos para la tabla `historico_precios`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impfiscales`
--

CREATE TABLE IF NOT EXISTS `impfiscales` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) collate utf8_spanish_ci NOT NULL,
  `path` varchar(64) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `impfiscales`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_categories`
--

CREATE TABLE IF NOT EXISTS `inventory_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(65) collate utf8_spanish_ci NOT NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `inventory_categories`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_counts`
--

CREATE TABLE IF NOT EXISTS `inventory_counts` (
  `id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL,
  `count` float NOT NULL default '0',
  `created` timestamp NULL default NULL,
  `modified` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `inventory_counts`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_products`
--

CREATE TABLE IF NOT EXISTS `inventory_products` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(65) collate utf8_spanish_ci NOT NULL,
  `category_id` int(11) default NULL,
  `created` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `inventory_products`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iva_responsabilidades`
--

CREATE TABLE IF NOT EXISTS `iva_responsabilidades` (
  `id` int(11) NOT NULL auto_increment,
  `codigo_fiscal` varchar(1) collate utf8_spanish_ci NOT NULL,
  `name` varchar(24) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `iva_responsabilidades`
--

INSERT INTO `iva_responsabilidades` (`id`, `codigo_fiscal`, `name`) VALUES
(1, 'I', 'Resp. Inscripto'),
(2, 'E', 'Exento'),
(3, 'A', 'No Responsable'),
(4, 'C', 'Consumidor Final'),
(5, 'T', 'No Categorizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE IF NOT EXISTS `mesas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `numero` int(11) NOT NULL,
  `mozo_id` int(10) unsigned NOT NULL,
  `subtotal` float NOT NULL default '0',
  `total` float(10,2) default '0.00',
  `cliente_id` int(10) unsigned default '0',
  `menu` tinyint(4) NOT NULL default '0' COMMENT 'es para cuando un cliente quiere imprimir el importe como MENU sin que se vea lo que consumio',
  `cant_comensales` int(11) default '0',
  `estado_id` tinyint(4) NOT NULL default '0',
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  `time_cerro` timestamp NOT NULL default '0000-00-00 00:00:00',
  `time_cobro` timestamp NOT NULL default '0000-00-00 00:00:00',
  `deleted_date` timestamp NULL default NULL,
  `deleted` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `time_cerro` (`time_cerro`,`time_cobro`),
  KEY `mozo_id` (`mozo_id`),
  KEY `numero` (`numero`),
  KEY `time_cobro` (`time_cobro`),
  KEY `created` (`time_cerro`,`mozo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;


INSERT INTO `mesas` (`id`, `numero`, `mozo_id`, `subtotal`, `total`, `cliente_id`, `menu`, `cant_comensales`, `estado_id`, `created`, `modified`, `time_cerro`, `time_cobro`, `deleted_date`, `deleted`) VALUES
(1, 23, 1, 0, 0.00, 0, 0, 4, 1, '2013-05-17 13:44:44', '2013-05-17 13:44:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0),
(2, 1, 1, 221, 221.00, 1, 0, 2, 2, '2013-05-17 13:51:19', '2013-05-17 13:52:24', '2013-05-17 13:52:24', '0000-00-00 00:00:00', NULL, 0),
(3, 3, 1, 0, 0.00, 0, 0, 2, 1, '2013-05-17 13:52:30', '2013-05-17 13:52:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0);

--
-- Volcar la base de datos para la tabla `mesas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mozos`
--

CREATE TABLE IF NOT EXISTS `mozos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned default NULL,
  `numero` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL default '0',
  `deleted_date` timestamp NULL default NULL,
  `deleted` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `numero` (`numero`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `mozos`
--

INSERT INTO `mozos` (`id`, `user_id`, `numero`, `activo`, `deleted_date`, `deleted`) VALUES
(1, 2, 1, 1, NULL, 0),
(2, 2, 4, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones`
--

CREATE TABLE IF NOT EXISTS `observaciones` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) collate utf8_spanish_ci NOT NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;


INSERT INTO `observaciones` (`name`) VALUES
("Observacion de comanda predefinida 1. Ejemplo: Marchar en 10 minutos"),
("Observacion 2");
--
-- Volcar la base de datos para la tabla `observaciones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observacion_comandas`
--

CREATE TABLE IF NOT EXISTS `observacion_comandas` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) collate utf8_spanish_ci NOT NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;


INSERT INTO `observacion_comandas` (`name`) VALUES
("Observacion predefinida 1 de producto. Ejemplo: SIN SAL"),
("Observacion 2 de producto");
--
-- Volcar la base de datos para la tabla `observacion_comandas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `mesa_id` int(10) unsigned NOT NULL,
  `tipo_de_pago_id` int(10) unsigned NOT NULL,
  `valor` float NOT NULL COMMENT 'por ahora este campo vale cuando el tipo de pago es mixto, entonces se pone la cantidad de efectivo que pagó. Para poder hacer el arqueo.',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `pagos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pquery_categories`
--

CREATE TABLE IF NOT EXISTS `pquery_categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) collate utf8_spanish_ci NOT NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `pquery_categories`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pquery_queries`
--

CREATE TABLE IF NOT EXISTS `pquery_queries` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(78) collate utf8_spanish_ci NOT NULL,
  `description` text collate utf8_spanish_ci,
  `query` text collate utf8_spanish_ci NOT NULL,
  `ver_online` tinyint(1) NOT NULL default '0',
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  `category_id` int(11) NOT NULL default '0',
  `expiration_time` timestamp NULL default NULL,
  `columns` text collate utf8_spanish_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `pquery_queries`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) collate utf8_spanish_ci NOT NULL,
  `abrev` varchar(28) collate utf8_spanish_ci NOT NULL,
  `description` text collate utf8_spanish_ci NOT NULL,
  `categoria_id` int(10) unsigned NOT NULL,
  `precio` float(10,2) NOT NULL,
  `comandera_id` int(11) NOT NULL,
  `order` int(11) default '0',
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  `deleted_date` timestamp NULL default NULL,
  `deleted` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `productos`
--


INSERT INTO `productos` (`id`, `name`, `abrev`, `description`, `categoria_id`, `precio`, `comandera_id`, `order`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
(1, 'Paella', 'paella', '', 1, 100.00, 0, NULL, '2012-11-28 23:11:57', '2012-11-28 23:11:57', NULL, 0),
(2, 'Pure', 'pure', '', 2, 12.00, 0, 2, '2013-05-17 13:50:34', '2013-05-17 13:50:34', NULL, 0),
(3, 'Papas Fritas', 'papas', '', 2, 33.00, 0, NULL, '2013-05-17 13:50:46', '2013-05-17 13:50:46', NULL, 0),
(4, 'Papa al Natural', 'papa', '', 2, 21.00, 0, 2, '2013-05-17 13:51:09', '2013-05-17 13:51:09', NULL, 0),
(5, 'Pepsi', 'pepsi', '', 3, 20.00, 0, NULL, '2014-04-02 06:52:34', '2014-04-02 06:52:34', NULL, 0),
(6, 'Big Ristorantino', 'bg risto', '', 4, 40.00, 0, 2, '2014-04-02 06:56:37', '2014-04-02 06:56:37', NULL, 0),
(7, 'Super de Pollo', 'pollo', '', 4, 33.00, 0, NULL, '2014-04-02 06:57:03', '2014-04-02 06:57:03', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_precios_futuros`
--

CREATE TABLE IF NOT EXISTS `productos_precios_futuros` (
  `id` int(11) NOT NULL auto_increment,
  `producto_id` int(11) NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `productos_precios_futuros`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(100) NOT NULL,
  `personas` int(11) NOT NULL,
  `mesa` text NOT NULL,
  `observaciones` text NOT NULL,
  `evento` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  `deleted_date` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `reservas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE IF NOT EXISTS `restaurantes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(60) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `restaurantes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sabores`
--

CREATE TABLE IF NOT EXISTS `sabores` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) collate utf8_spanish_ci NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` float NOT NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  `deleted_date` timestamp NULL default NULL,
  `deleted` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);


INSERT INTO `sabores` (`id`, `name`, `categoria_id`, `precio`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
(1, 'Queso', 4, 10, '2014-04-02 06:54:36', '2014-04-02 06:54:36', NULL, 0),
(2, 'Tomate', 4, 5, '2014-04-02 06:54:47', '2014-04-02 06:54:47', NULL, 0),
(3, 'Lechuga', 4, 4, '2014-04-02 06:55:00', '2014-04-02 06:55:00', NULL, 0),
(4, 'Huevo', 4, 5, '2014-04-02 06:55:29', '2014-04-02 06:55:29', NULL, 0),
(5, 'Sola', 4, 0, '2014-04-02 06:58:00', '2014-04-02 06:58:00', NULL, 0);
--
-- Volcar la base de datos para la tabla `sabores`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_pagos`
--

CREATE TABLE IF NOT EXISTS `tipo_de_pagos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(110) collate utf8_spanish_ci NOT NULL,
  `description` text collate utf8_spanish_ci,
  `image_url` varchar(200) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `tipo_de_pagos`
--

INSERT INTO `tipo_de_pagos` (`id`, `name`, `description`, `image_url`) VALUES
(1, 'Efectivo', 'cobro de dinero en efectivo', 'dollar_icon.png'),
(2, 'No Paga', '', 'no_paga.png'),
(3, 'Tarjeta Amex', '', 'american_express_icon.png'),
(4, 'Tarjeta Visa', '', 'visa_icon.png'),
(5, 'Tarjeta Master Card', '', 'mastercard_icon.png'),
(6, 'Tarjeta Visa Debito', '', '1315361034_visa_electron_curved.png'),
(7, 'Tarjeta Maestro', '', 'maestro_icon.png'),
(8, 'No volvio Cupon', '', 'no_volvio_cupon.png'),
(9, 'Dudoso', 'pago que no se si pagaron con tarjeta, efectivo, etc...', 'dudoso.png'),
(10, 'Voucher Cine', '', 'check_icon.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documentos`
--

CREATE TABLE IF NOT EXISTS `tipo_documentos` (
  `id` int(11) NOT NULL auto_increment,
  `codigo_fiscal` varchar(1) collate utf8_spanish_ci NOT NULL,
  `name` varchar(24) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `tipo_documentos`
--

INSERT INTO `tipo_documentos` (`id`, `codigo_fiscal`, `name`) VALUES
(1, 'C', 'CUIT'),
(2, 'L', 'CUIL'),
(3, '0', 'Libreta de Enrolamiento'),
(4, '1', 'Libreta Cívica'),
(5, '2', 'DNI'),
(6, '3', 'Pasaporte'),
(7, '4', 'Cédula de Identidad'),
(8, '-', 'Sin identificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_facturas`
--

CREATE TABLE IF NOT EXISTS `tipo_facturas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) collate utf8_spanish_ci NOT NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `tipo_facturas`
--

INSERT INTO `tipo_facturas` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Factura "A"', '2010-03-27 20:04:20', '2010-03-27 20:04:20'),
(2, 'Factura "B"', '2010-03-27 20:04:27', '2010-03-27 20:04:27'),
(3, 'Remito "X"', '2010-03-27 20:04:36', '2010-03-27 20:04:36'),
(4, 'Factura "M"', '2010-03-27 20:04:42', '2010-03-27 20:04:42'),
(5, 'Factura "C"', '2010-03-27 20:04:48', '2010-03-27 20:04:48'),
(6, 'Vale', '2010-03-27 20:04:54', '2010-03-27 20:04:54'),
(7, 'Otros', '2010-03-27 20:05:18', '2010-03-27 20:05:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(50) collate utf8_spanish_ci NOT NULL,
  `password` varchar(50) collate utf8_spanish_ci NOT NULL,
  `role` varchar(64) collate utf8_spanish_ci NOT NULL default 'invitado',
  `nombre` varchar(40) collate utf8_spanish_ci NOT NULL,
  `apellido` varchar(40) collate utf8_spanish_ci NOT NULL default '''''',
  `telefono` varchar(20) collate utf8_spanish_ci default NULL,
  `domicilio` varchar(110) collate utf8_spanish_ci NOT NULL default '''''',
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nombre`, `apellido`, `telefono`, `domicilio`, `created`, `modified`) VALUES
(1, 'admin', 'fa2d96c466f88d70992f6ef17258dce71491daa5', 'invitado', 'admin', 'admin', '', '', '2012-11-24 23:51:09', '2012-11-28 23:13:31'),
(2, 'mozo', 'b75f1329505041fb0e1eb121245f50701566f481', 'invitado', 'Jose Manolo', 'Perez', '', '''''', '2012-11-28 21:47:38', '2012-11-28 23:14:07');