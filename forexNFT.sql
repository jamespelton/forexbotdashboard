CREATE DATABASE ForexNFTs;

USE ForexNFTs;

CREATE TABLE Balances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    account VARCHAR(255) NOT NULL,
    balance DECIMAL(20,2) NOT NULL 
);