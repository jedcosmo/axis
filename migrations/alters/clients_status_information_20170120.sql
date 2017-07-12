/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  jdymosco
 * Created: Jan 20, 2017
 */
ALTER TABLE `clients_status_information` ADD `medicare_number` VARCHAR(250) NULL DEFAULT NULL AFTER `medicare_eligibility_active`;

