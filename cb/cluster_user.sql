INSERT INTO `tbl_user_mst` (`user_group_id`, `login_password`, `login_username`, `ref_id`, `user_display_name`, `user_contact`) VALUES (17, '12345678', 'Arnabi Ghosh.1', 1, 'Ms. Arnabi Ghosh\r', '+91 9007213719');
INSERT INTO `tbl_user_mst` (`user_group_id`, `login_password`, `login_username`, `ref_id`, `user_display_name`, `user_contact`) VALUES (17, '12345678', '. UdayshankarSwain.2', 2, 'Mr. Udayshankar Swain', NULL);
INSERT INTO `tbl_user_mst` (`user_group_id`, `login_password`, `login_username`, `ref_id`, `user_display_name`, `user_contact`) VALUES (17, '12345678', 'SogharaRizvi.3', 3, 'Ms. Soghara Rizvi', NULL);
INSERT INTO `tbl_user_mst` (`user_group_id`, `login_password`, `login_username`, `ref_id`, `user_display_name`, `user_contact`) VALUES (17, '12345678', 'SujeetKarn.7', 7, 'Mr. Sujeet Karn', '+91 8451-0510-8');
select `user_group_id`,    '12345678' as `login_password`,concat(u.user_name,'.',u.cluster_user_id) as login_username, u.cluster_user_id as  `ref_id`,u.user_name as user_display_name,u.user_mobile as user_contact from tbl_user_mst m
 join tbl_cluster_users u on m.ref_id=u.cluster_id
 where m.user_group_id=7