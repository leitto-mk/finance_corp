DELIMITER $$
CREATE PROCEDURE `retaining_earnings_update` (IN `val_branch` VARCHAR(255), IN `val_year` INT(11), IN `val_month` INT(11))
BEGIN
   START TRANSACTION;

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

   SELECT @retaining := (@revenue - @expense);

   -- REVENUE-EXPENSE EACH OF SELECTED MONTH --
   UPDATE `tbl_fa_retaining_earning`
   SET Retaining = @retaining
   WHERE Branch = val_branch
   AND Year = val_year
   AND Month = val_month;

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