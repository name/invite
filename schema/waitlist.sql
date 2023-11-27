CREATE TABLE waitlist (
  id INT AUTO_INCREMENT PRIMARY KEY,
  x_username VARCHAR(255) NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status ENUM('pending', 'accepted', 'invited') NOT NULL DEFAULT 'pending',
  invite_code VARCHAR(255) UNIQUE,
  invited_at TIMESTAMP NULL
);
