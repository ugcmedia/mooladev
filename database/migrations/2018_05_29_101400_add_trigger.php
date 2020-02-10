<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	DB::unprepared("	CREATE TRIGGER `userCbTracked` AFTER INSERT ON `tb_user_transaction`
 FOR EACH ROW BEGIN 

INSERT INTO `tb_user_transaction_changes` (`chgid`, `user_id`, `transaction_id`, `utrid`, `change_type`, `change_time`, `old_status`, `new_status`, `old_cashback`, `new_cashback`, `email_sent`) VALUES (NULL, NEW.user_id, NEW.transaction_id, NEW.utrid, 'insert', CURRENT_TIMESTAMP, NEW.status, NEW.status,NEW.cashback_amount, NEW.cashback_amount, 'N');

END
");
DB::unprepared("
CREATE TRIGGER `userCbUpdated` AFTER UPDATE ON `tb_user_transaction`
 FOR EACH ROW INSERT INTO `tb_user_transaction_changes` VALUES (NULL, OLD.user_id, OLD.transaction_id, OLD.utrid, 'update', CURRENT_TIMESTAMP, OLD.status, NEW.status,OLD.cashback_amount, NEW.cashback_amount, 'N');
 END
");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
