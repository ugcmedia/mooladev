<div class="table-responsive-lg">
<table class="table border">
    <thead class="thead-light">
        <tr>
            <th scope="col">{{__('member/multi_lang.date')}}</th>
            <th scope="col">{{__('member/multi_lang.mer')}}</th>
            <th scope="col">{{__('member/multi_lang.estimate')}}</th>
			<th scope="col">{{__('member/multi_lang.order_amt')}}</th>
            <th scope="col">{{__('member/multi_lang.status')}}</th>
            <th scope="col">{{__('member/multi_lang.expected_by')}}</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    @if(Count($data['cashback_data'] ) > 0)
      @foreach($data['cashback_data'] as $cashback)
        <tr data-toggle="collapse" data-target="#cbtr{{$cashback->transaction_id}}" class="accordion-toggle">

            <td>{{date(config('sximo.cnf_date'),strtotime($cashback->transaction_time))}}</td>
            <td>{{$cashback->store_name}}</td>
            <td>{{config('sximo.cnf_currencyname')}}{{$cashback->cashback_amount}}{{config('sximo.cnf_currencysuffix')}}</td>
			<td>{{config('sximo.cnf_currencyname')}}{{$cashback->transaction_amount}}{{config('sximo.cnf_currencysuffix')}}
            @if(config('settingConfig.module_rewards')=='Y')<br>{{ucfirst($cashback->cashback_type)}}@endif</td>
			<td>{{ucfirst($cashback->status)}}</td>
		    <td>@if($cashback->status=='pending')<?php  echo  date(config('sximo.cnf_date'),strtotime($cashback->transaction_time.' + '. $data['network_days'][$cashback->network_id] .' days')) ?>@endif </td>
            <td>{{__('member/multi_lang.more_info')}} <i class="fa fa-angle-down"></i></td>
        </tr>
		<?php if(  isset($data['cashback_meta'][$cashback->transaction_id]) ) : ?>
		<tr>
			<td colspan="100" class="hiddenRow">
			<div id="cbtr{{$cashback->transaction_id}}" class="accordian-body p-3 collapse">
				<div class="row"><div class="col-md-12">
					<?php


					$wthMeta = $data['cashback_meta'][$cashback->transaction_id];

					$firstMeta = $wthMeta[0];
					if(count($wthMeta)<2)
						$lastMeta = null;
					else
					$lastMeta = $wthMeta[ count($wthMeta)-1];

					if(count($wthMeta)>2)
					{ $withdrawMeta = $wthMeta;  unset($withdrawMeta[0]);unset($withdrawMeta[count($wthMeta)-1]);}
					else
						$withdrawMeta = array();


				?>

				<ul class="cbp_tmtimeline">
                <li>
                    <time class="cbp_tmtime" datetime="{{$firstMeta['change_time']}}"><span class="hidden">{{date(config('sximo.cnf_date'),strtotime($firstMeta['change_time']))}}</span>
					<span >{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $firstMeta['change_time'])->diffForHumans()}}</span></time>
                    <div class="cbp_tmicon"><i class="fa fa-flag"></i></div>
                    <div class="cbp_tmlabel empty">
					<span>{{__('member/multi_lang.history_status')}} - {{ucfirst($firstMeta['status'])}}</span><br>
					<span>{{__('member/multi_lang.history_amount')}} - {{ucfirst($firstMeta['amount'])}}</span>
					</div>
                </li>

				<?php foreach($withdrawMeta as $withDetail) {	?>

				 <li>
                    <time class="cbp_tmtime" datetime="{{$withDetail['change_time']}}">
					<span>{{date(config('sximo.cnf_date'),strtotime($withDetail['change_time']))}}</span>
					<span>{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $withDetail['change_time'])->diffForHumans()}}</span></time>
                    <div class="cbp_tmicon {{AppClass::getBgClassByStatus($withDetail['status']) }}"> <i class="fa fa-step-forward"></i></div>
                    <div class="cbp_tmlabel">
					 <span>{{__('member/multi_lang.history_status')}} - {{ucfirst($withDetail['status'])}}</span><br>
					 <span>{{__('member/multi_lang.history_amount')}} - {{ucfirst($withDetail['amount'])}}</span>
                    </div>
                </li>


				<?php } ?>

				<?php if($lastMeta) :?>

				 <li>
                    <time class="cbp_tmtime" datetime="{{$lastMeta['change_time']}}">
					<span>{{date(config('sximo.cnf_date'),strtotime($lastMeta['change_time']))}}</span>
					<span>{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $lastMeta['change_time'])->diffForHumans()}}</span></time>
                    <div class="cbp_tmicon bg-dark"><i class="fa fa-flag-checkered"></i></div>
                    <div class="cbp_tmlabel">
                        <span>{{__('member/multi_lang.history_status')}} - {{ucfirst($lastMeta['status'])}}</span><br>
						<span>{{__('member/multi_lang.history_amount')}} - {{ucfirst($lastMeta['amount'])}}</span>
                    </div>
                </li>

				<?php endif; ?>

				</ul>

				</div></div>
			</div>
			</td>
		</tr>
		<?php else :?>
		<tr>
		<td colspan="5" class="hiddenRow">
		<div id="cbtr{{$cashback->transaction_id}}" class="accordian-body p-3 collapse">
		{{__('member/multi_lang.sorry_found')}}!
		</div>
		</td>
		</tr>
		<?php endif;?>
        @endforeach
        @else
        <tr data-toggle="collapse" data-target="#demo13" class="accordion-toggle">
            <td colspan="6">{{__('member/multi_lang.sorry_found')}}!</td>
          </tr>
          @endif
    </tbody>
</table>
</div>
{!!   $data['cashback_data']->render() !!}
