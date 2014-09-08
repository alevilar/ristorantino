-- --------------------------------------------------------

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `rol_id`, `password`, `nombre`, `apellido`, `telefono`, `domicilio`, `created`, `modified`) VALUES
(1, 'admin', 1, 'fa2d96c466f88d70992f6ef17258dce71491daa5', 'admin', 'admin', '', '', '2012-11-24 23:51:09', '2012-11-28 23:13:31'),
(2, 'mozo', 2, '47efd45d1cc31fce5f466b57e53f3f064875a945', 'Mozo', 'Mozo', '', '''''', '2012-11-28 21:47:38', '2012-11-28 23:14:07');


INSERT INTO `sites` (`id`, `name`, `alias`, `enabled`, `created`, `modified`) VALUES
(1, 'tenant1', 'tenant1', 1, NULL, NULL);


INSERT INTO `sites_users` (`id`, `user_id`, `site_id`, `created`, `updated`) VALUES
(1, 1, 1, NULL, NULL);

