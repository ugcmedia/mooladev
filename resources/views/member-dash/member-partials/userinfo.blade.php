<div class="user-info">
	<p class="text-muted font-weight-bold mb-2">{{__('member/multi_lang.welcome')}}</p>
	
		<h5>{{Session::get('memberDetail')->first_name .' '. Session::get('memberDetail')->last_name }} </h5>
		<p class="text-muted mb-0">{{__('member/multi_lang.member_since')}} {{date(config('sximo.cnf_date'),strtotime(Session::get('memberDetail')->join_date))}} </p>
		<p class="edit-profile mb-2"><a href="{{url('member/profile-settings')}}"><i class="fa fa-pencil"></i>{{__('member/multi_lang.edit_profile')}} </a></p>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip()

		<?php if ($message = Session::get('success')) { ?>
				toastr.success('{{$message}}', 'Success');
		<?php } ?>
			<?php if ($message = Session::get('error')) { ?>
					toastr.error('{{$message}}', 'Error');
			<?php  } ?>
	});
</script>
