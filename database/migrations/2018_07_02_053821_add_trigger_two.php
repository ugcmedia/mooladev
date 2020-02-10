<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTriggerTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		DB::unprepared("DROP TRIGGER IF EXISTS admAltPayout");
		DB::unprepared("CREATE TRIGGER `admAltPayout` AFTER INSERT ON `tb_user_withdrawals` FOR EACH ROW INSERT INTO `tb_notification` (SELECT NULL as uid,1 userid ,CONCAT('/',module_name,'/',NEW.withdrawal_id,'/edit?return=') url ,module_title title,module_note note,CURRENT_TIMESTAMP created,NULL icon,'0' is_read,1 postedBy FROM `tb_module` WHERE module_db = 'tb_user_withdrawals')");
		
		DB::unprepared("DROP TRIGGER IF EXISTS withdrawalInsert");
		DB::unprepared("CREATE TRIGGER `withdrawalInsert` AFTER INSERT ON `tb_user_withdrawals` FOR EACH ROW INSERT INTO `tb_user_withdrawals_changes`  VALUES (NULL, NEW.withdrawal_id,'insert', NEW.status, NEW.status, CURRENT_TIMESTAMP, 'N', 'N')");
		
		
		DB::unprepared("DROP TRIGGER IF EXISTS withdrawalUpdates");
		DB::unprepared("CREATE TRIGGER `withdrawalUpdates` AFTER UPDATE ON `tb_user_withdrawals` FOR EACH ROW IF(NEW.status<>OLD.status)
THEN
INSERT INTO `tb_user_withdrawals_changes`  VALUES (NULL, OLD.withdrawal_id,'update', OLD.status, NEW.status, CURRENT_TIMESTAMP, 'N', 'N');
END IF");


		DB::unprepared("DROP TRIGGER IF EXISTS admAltComment");
		DB::unprepared("CREATE TRIGGER `admAltComment` AFTER INSERT ON `tb_comments` FOR EACH ROW INSERT INTO `tb_notification` (SELECT NULL as uid,1 userid ,CONCAT('/',module_name,'/',NEW.commentID,'/edit?return=') url ,module_title title,module_note note,CURRENT_TIMESTAMP created,NULL icon,'0' is_read,1 postedBy FROM `tb_module` WHERE module_db = 'tb_comments')");
		
		
		DB::unprepared("DROP TRIGGER IF EXISTS admAltContact");
		DB::unprepared("CREATE TRIGGER `admAltContact` AFTER INSERT ON `tb_contacts` FOR EACH ROW INSERT INTO `tb_notification` (SELECT NULL as uid,1 userid ,CONCAT('/',module_name,'/',NEW.contact_id,'/edit?return=') url ,module_title title,module_note note,CURRENT_TIMESTAMP created,NULL icon,'0' is_read,1 postedBy FROM `tb_module` WHERE module_db = 'tb_contacts')");
		
		
		DB::unprepared("DROP TRIGGER IF EXISTS admAltCpnComment");
		DB::unprepared("CREATE TRIGGER `admAltCpnComment` AFTER INSERT ON `tb_coupon_comments` FOR EACH ROW INSERT INTO `tb_notification` (SELECT NULL as uid,1 userid ,CONCAT('/',module_name,'/',NEW.coupon_id,'/edit?return=') url ,module_title title,module_note note,CURRENT_TIMESTAMP created,NULL icon,'0' is_read,1 postedBy FROM `tb_module` WHERE module_db = 'tb_coupons')");
		
		
		DB::unprepared("DROP TRIGGER IF EXISTS admAltMissingCB");
		DB::unprepared("CREATE TRIGGER `admAltMissingCB` AFTER INSERT ON `tb_missing_cashback` FOR EACH ROW INSERT INTO `tb_notification` (SELECT NULL as uid,1 userid ,CONCAT('/',module_name,'/',NEW.tick_pkey,'/edit?return=') url ,module_title title,module_note note,CURRENT_TIMESTAMP created,NULL icon,'0' is_read,1 postedBy FROM `tb_module` WHERE module_db = 'tb_missing_cashback')");
		
		DB::unprepared("DROP TRIGGER IF EXISTS claimUpdate");
		DB::unprepared("CREATE TRIGGER `claimUpdate` AFTER UPDATE ON `tb_missing_cashback` FOR EACH ROW INSERT INTO `tb_missing_cashback_changes` VALUES (NULL, NEW.tick_pkey, OLD.tick_status, NEW.tick_status, CURRENT_TIMESTAMP, 'N', 'N')");
		
		
		DB::unprepared("DROP TRIGGER IF EXISTS admAltMissingCBCmt");
		DB::unprepared("CREATE TRIGGER `admAltMissingCBCmt` AFTER INSERT ON `tb_missing_cashback_comments` FOR EACH ROW INSERT INTO `tb_notification` (SELECT NULL as uid,1 userid ,CONCAT('/',module_name,'/',NEW.mccid,'/edit?return=') url ,module_title title,module_note note,CURRENT_TIMESTAMP created,NULL icon,'0' is_read,1 postedBy FROM `tb_module` WHERE module_db = 'tb_missing_cashback_comments')");
		
		
		DB::unprepared("DROP TRIGGER IF EXISTS admAltTranCapture");
		DB::unprepared("CREATE TRIGGER `admAltTranCapture` AFTER INSERT ON `tb_network_transactions` FOR EACH ROW INSERT INTO `tb_notification` (SELECT NULL as uid,1 userid ,CONCAT('/',module_name,'/',NEW.netrid,'/edit?return=') url ,module_title title,module_note note,CURRENT_TIMESTAMP created,NULL icon,'0' is_read,1 postedBy FROM `tb_module` WHERE module_db = 'tb_network_transactions')");


		DB::unprepared("DROP TRIGGER IF EXISTS admAltTicket");
		DB::unprepared("CREATE TRIGGER `admAltTicket` AFTER INSERT ON `tb_tickets` FOR EACH ROW INSERT INTO `tb_notification` (SELECT NULL as uid,1 userid ,CONCAT('/',module_name,'/',NEW.ticket_id,'/edit?return=') url ,module_title title,module_note note,CURRENT_TIMESTAMP created,NULL icon,'0' is_read,1 postedBy FROM `tb_module` WHERE module_db = 'tb_tickets')");
		
		
		DB::unprepared("DROP TRIGGER IF EXISTS admAltTicketCmt");
		DB::unprepared("CREATE TRIGGER `admAltTicketCmt` AFTER INSERT ON `tb_ticket_comments` FOR EACH ROW INSERT INTO `tb_notification` (SELECT NULL as uid,1 userid ,CONCAT('/',module_name,'/',NEW.tcmid,'/edit?return=') url ,module_title title,module_note note,CURRENT_TIMESTAMP created,NULL icon,'0' is_read,1 postedBy FROM `tb_module` WHERE module_db = 'tb_ticket_comments')");
		
		
		DB::unprepared("DROP TRIGGER IF EXISTS bonusAdd");
		DB::unprepared("CREATE TRIGGER `bonusAdd` AFTER INSERT ON `tb_user_bonus` FOR EACH ROW INSERT INTO `tb_user_bonus_changes` VALUES (NULL, NEW.bonus_id,'insert', NEW.status, NEW.status, CURRENT_TIMESTAMP, 'N', 'N')");
		
		DB::unprepared("DROP TRIGGER IF EXISTS bonusConv");
		DB::unprepared("CREATE TRIGGER `bonusConv` AFTER UPDATE ON `tb_user_bonus` FOR EACH ROW IF(NEW.status<>OLD.status)
THEN

INSERT INTO `tb_user_bonus_changes` VALUES (NULL, OLD.bonus_id,'update', OLD.status, NEW.status, CURRENT_TIMESTAMP, 'N', 'N');

END IF
");


		DB::unprepared("DROP TRIGGER IF EXISTS referralCapture");
		DB::unprepared("CREATE TRIGGER `referralCapture` AFTER INSERT ON `tb_user_referrals` FOR EACH ROW INSERT INTO `tb_user_referrals_changes` VALUES (NULL, NEW.refid, NEW.status, NEW.status,'insert', CURRENT_TIMESTAMP, 'N', 'N')");
		
		DB::unprepared("DROP TRIGGER IF EXISTS referralConv");
		DB::unprepared("CREATE TRIGGER `referralConv` AFTER UPDATE ON `tb_user_referrals` FOR EACH ROW IF(NEW.status<>OLD.status)
THEN
INSERT INTO `tb_user_referrals_changes` VALUES (NULL, OLD.refid, OLD.status, NEW.status,'update', CURRENT_TIMESTAMP, 'N', 'N');
END IF");


		DB::unprepared("DROP TRIGGER IF EXISTS admAltCashback");
		DB::unprepared("
CREATE TRIGGER `admAltCashback` AFTER INSERT ON `tb_user_transaction` FOR EACH ROW INSERT INTO `tb_notification` (SELECT NULL as uid,1 userid ,CONCAT('/',module_name,'/',NEW.utrid,'/edit?return=') url ,module_title title,module_note note,CURRENT_TIMESTAMP created,NULL icon,'0' is_read,1 postedBy FROM `tb_module` WHERE module_db = 'tb_user_transaction')");
		
		DB::unprepared("DROP TRIGGER IF EXISTS userCbTracked");
		DB::unprepared("CREATE TRIGGER `userCbTracked` AFTER INSERT ON `tb_user_transaction`
 FOR EACH ROW BEGIN 

INSERT INTO `tb_user_transaction_changes` VALUES (NULL, NEW.user_id, NEW.transaction_id, NEW.utrid, 'insert', CURRENT_TIMESTAMP, NEW.status, NEW.status,NEW.cashback_amount, NEW.cashback_amount, 'N','N');

END
");
		DB::unprepared("DROP TRIGGER IF EXISTS userCbUpdated");
		DB::unprepared("CREATE TRIGGER `userCbUpdated` AFTER UPDATE ON `tb_user_transaction` FOR EACH ROW IF(NEW.status<>OLD.status OR OLD.cashback_amount <> NEW.cashback_amount)
THEN

INSERT INTO `tb_user_transaction_changes` VALUES (NULL, OLD.user_id, OLD.transaction_id, OLD.utrid, 'update', CURRENT_TIMESTAMP, OLD.status, NEW.status,OLD.cashback_amount, NEW.cashback_amount, 'N','N');

END IF
");
		
		DB::unprepared("DROP TRIGGER IF EXISTS delCpnCmt");
		DB::unprepared("DROP TRIGGER IF EXISTS insCpnCmt");
		DB::unprepared("DROP TRIGGER IF EXISTS updCpnCmt");
		
		DB::unprepared("CREATE TRIGGER `delCpnCmt` AFTER DELETE ON `tb_coupon_comments`
 FOR EACH ROW UPDATE `tb_coupons` SET comment_count = (SELECT COUNT(*) FROM `tb_coupon_comments` WHERE coupon_id = OLD.coupon_id AND published = 'Y') WHERE coupon_id = OLD.coupon_id");
		DB::unprepared("CREATE TRIGGER `insCpnCmt` AFTER INSERT ON `tb_coupon_comments`
 FOR EACH ROW UPDATE `tb_coupons` SET comment_count = (SELECT COUNT(*) FROM `tb_coupon_comments` WHERE coupon_id = NEW.coupon_id AND published = 'Y') WHERE coupon_id = NEW.coupon_id");
		DB::unprepared("CREATE TRIGGER `updCpnCmt` AFTER UPDATE ON `tb_coupon_comments`
 FOR EACH ROW UPDATE `tb_coupons` SET comment_count = (SELECT COUNT(*) FROM `tb_coupon_comments` WHERE coupon_id = NEW.coupon_id AND published = 'Y') WHERE coupon_id = NEW.coupon_id");
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		
		DB::unprepared("DROP TRIGGER IF EXISTS userCbUpdated");
DB::unprepared("DROP TRIGGER IF EXISTS userCbTracked");
DB::unprepared("DROP TRIGGER IF EXISTS admAltCashback");
DB::unprepared("DROP TRIGGER IF EXISTS referralConv");
DB::unprepared("DROP TRIGGER IF EXISTS referralCapture");
DB::unprepared("DROP TRIGGER IF EXISTS bonusConv");
DB::unprepared("DROP TRIGGER IF EXISTS bonusAdd");
DB::unprepared("DROP TRIGGER IF EXISTS admAltTicketCmt");
DB::unprepared("DROP TRIGGER IF EXISTS admAltTicket");
DB::unprepared("DROP TRIGGER IF EXISTS admAltTranCapture");
DB::unprepared("DROP TRIGGER IF EXISTS admAltMissingCBCmt");
DB::unprepared("DROP TRIGGER IF EXISTS claimUpdate");
DB::unprepared("DROP TRIGGER IF EXISTS admAltMissingCB");
DB::unprepared("DROP TRIGGER IF EXISTS admAltCpnComment");
DB::unprepared("DROP TRIGGER IF EXISTS admAltContact");
DB::unprepared("DROP TRIGGER IF EXISTS admAltComment");
DB::unprepared("DROP TRIGGER IF EXISTS withdrawalUpdates");
DB::unprepared("DROP TRIGGER IF EXISTS withdrawalInsert");
DB::unprepared("DROP TRIGGER IF EXISTS admAltPayout");

    }
}
