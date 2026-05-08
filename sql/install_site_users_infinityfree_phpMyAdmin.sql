-- =============================================================================
-- InfinityFree / phpMyAdmin: add LAB users ONLY (does not replace your users table)
-- =============================================================================
-- Steps:
-- 1. phpMyAdmin → select database IF0_xxxxx_halovoyage ( Structure tab ).
-- 2. Click SQL tab → paste EVERYTHING below (no edits needed unless DB name differs).
-- 3. Click Go.
-- You should see NEW table **site_users** with 22 rows. Keep **users** as-is for combined_users.
-- =============================================================================

CREATE TABLE IF NOT EXISTS `site_users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(80) NOT NULL,
  `last_name` VARCHAR(80) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `home_address` VARCHAR(500) NOT NULL,
  `home_phone` VARCHAR(40) NOT NULL,
  `cell_phone` VARCHAR(40) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_site_users_email` (`email`),
  KEY `idx_site_users_name` (`last_name`, `first_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `site_users` (`first_name`, `last_name`, `email`, `home_address`, `home_phone`, `cell_phone`) VALUES
('Maya', 'Chen', 'maya.chen@email.test', '1200 Market St, San Jose, CA 95112', '(408) 555-0142', '(408) 555-8921'),
('Jordan', 'Reyes', 'jordan.reyes@email.test', '44 Palm Ave, Los Angeles, CA 90001', '(323) 555-2201', '(323) 555-7734'),
('Samira', 'Hassan', 'samira.hassan@email.test', '9 Lakeview Rd, Fremont, CA 94538', '(510) 555-6610', '(510) 555-4412'),
('Ethan', 'Park', 'ethan.park@email.test', '300 Valencia St, San Francisco, CA 94103', '(415) 555-9900', '(415) 555-1209'),
('Olivia', 'Nguyen', 'olivia.nguyen@email.test', '88 Harbor Dr, San Diego, CA 92101', '(619) 555-4488', '(619) 555-3012'),
('Liam', 'Okonkwo', 'liam.okonkwo@email.test', '5 Broadway, Oakland, CA 94607', '(510) 555-7788', '(510) 555-9033'),
('Ava', 'Martinez', 'ava.martinez@email.test', '210 Maple St, Sacramento, CA 95814', '(916) 555-5566', '(916) 555-2211'),
('Noah', 'Singh', 'noah.singh@email.test', '17 Cedar Ln, Mountain View, CA 94043', '(650) 555-3344', '(650) 555-8877'),
('Priya', 'Desai', 'priya.desai@email.test', '402 El Camino Real, Palo Alto, CA 94306', '(650) 555-6120', '(650) 555-1599'),
('Ben', 'Foster', 'ben.foster@email.test', '77 Bay St, Santa Cruz, CA 95060', '(831) 555-4820', '(831) 555-7113'),
('Riley', 'Thompson', 'riley.thompson@email.test', '19 Hill Rd, Berkeley, CA 94704', '(510) 555-9281', '(510) 555-3044'),
('Sofia', 'Almeida', 'sofia.almeida@email.test', '608 River Rd, Pasadena, CA 91103', '(626) 555-1188', '(626) 555-6405'),
('Diego', 'Castillo', 'diego.castillo@email.test', '250 Sunrise Blvd, Riverside, CA 92506', '(951) 555-2299', '(951) 555-8804'),
('Mia', 'Kowalski', 'mia.kowalski@email.test', '33 Pine St, San Mateo, CA 94403', '(650) 555-7660', '(650) 555-1223'),
('Caleb', 'Wright', 'caleb.wright@email.test', '900 Castro St, Redwood City, CA 94061', '(650) 555-3456', '(650) 555-9101'),
('Nina', 'Patel', 'nina.patel@email.test', '12 Blossom Way, Irvine, CA 92618', '(949) 555-7744', '(949) 555-2288'),
('Hugo', 'Silva', 'hugo.silva@email.test', '45 Ocean Ave, Long Beach, CA 90803', '(562) 555-6601', '(562) 555-9955'),
('Emma', 'Brooks', 'emma.brooks@email.test', '8 Vineyard Cir, Napa, CA 94558', '(707) 555-4477', '(707) 555-3300'),
('Arjun', 'Mehta', 'arjun.mehta@email.test', '511 Union Sq, Walnut Creek, CA 94596', '(925) 555-8123', '(925) 555-4679'),
('Zoe', 'Larsson', 'zoe.larsson@email.test', '66 Bridge St, Ventura, CA 93003', '(805) 555-2590', '(805) 555-7012'),
('Tyler', 'Johnson', 'tyler.johnson@email.test', '1440 Pine Ave, Fresno, CA 93721', '(559) 555-8844', '(559) 555-1166'),
('Grace', 'Okafor', 'grace.okafor@email.test', '3 Sunrise Ct, Anaheim, CA 92805', '(714) 555-3322', '(714) 555-9099');
