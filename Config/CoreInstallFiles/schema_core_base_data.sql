NSERT INTO `users` (`id`, `username`, `slug`, `password`, `password_token`, `email`, `email_verified`, `email_token`, `email_token_expires`, `tos`, `active`, `last_login`, `last_action`, `is_admin`, `rol_id`, `created`, `modified`)
VALUES ('51c72ce4-3d19-11e4-b73c-208984c70abd', 'admin', '', 'fa2d96c466f88d70992f6ef17258dce71491daa5', NULL, 'admin@admin.com', '1', NULL, NULL, '0', '1', NULL, NULL, '0', '1', NULL, NULL),
('51c72ce4-3d19-11e4-b73c-208964534jjfk', 'mozo', '', 'fa2d96c466f88d70992f6ef17258dce71491daa5', NULL, 'mozo@mozo.com', '1', NULL, NULL, '0', '1', NULL, NULL, '0', '2', NULL, NULL);

INSERT INTO `sites` (`id`, `name`, `alias`, `enabled`, `created`, `modified`) VALUES
(1, 'tenant1', 'tenant1', 1, NULL, NULL);


INSERT INTO `sites_users` (`id`, `user_id`, `site_id`, `created`, `updated`) VALUES
(1, 1, 1, NULL, NULL);