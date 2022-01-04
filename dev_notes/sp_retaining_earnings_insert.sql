DELIMITER $$
CREATE PROCEDURE `retaining_earnings_insert` (IN `val_branch` VARCHAR(255), IN `val_year` INT(11), IN `val_month` INT(11))
BEGIN
   START TRANSACTION;

   -- DELETE PREVIOUS DATA IF EXISTS --
   DELETE FROM `tbl_fa_retaining_earning`
   WHERE Branch = val_branch
   AND Year = val_year
   AND Month = val_month;

   -- GET ACCUMULATED ACCNO AMOUNT --
   SELECT @revenue := IFNULL((
         SELECT SUM(Amount) FROM tbl_fa_transaction
         WHERE Branch = val_branch
         AND YEAR(TransDate) = val_year AND MONTH(TransDate) = val_month
         AND AccType IN ('R', 'R1')
   ),0);

   SELECT @expense := IFNULL((
         SELECT SUM(Amount) FROM tbl_fa_transaction
         WHERE Branch = val_branch
         AND YEAR(TransDate) = val_year AND MONTH(TransDate) = val_month
         AND AccType IN ('E', 'E1')
   ),0);

   -- GET RETAINING EARNING FROM GENERAL JOURNAL INPUT --
   SELECT @generaljournal_re := IFNULL((
         SELECT SUM(Amount) FROM tbl_fa_transaction
         WHERE Branch = val_branch
         AND YEAR(TransDate) = val_year AND MONTH(TransDate) = val_month
         AND AccType IN ('C1')
   ),0);

   SELECT @retaining := (@revenue - @expense) + @generaljournal_re;

   -- REVENUE-EXPENSE EACH OF SELECTED MONTH --
   INSERT INTO `tbl_fa_retaining_earning` (Branch, Year, Month, Retaining)
   SELECT val_branch, val_year, val_month, @retaining;

   -- SUM EACH OF SELECTED MONTH --
   UPDATE `tbl_fa_retaining_earning` AS parent
   SET RetainingSum = (
      SELECT SUM(Retaining) FROM tbl_fa_retaining_earning
      WHERE Branch = val_branch
      AND Year = val_year
      AND Month <= parent.Month
   )
   WHERE Branch = val_branch
   AND Year = val_year;

   COMMIT;
END $$