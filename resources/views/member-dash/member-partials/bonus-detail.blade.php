<div class="table-responsive-lg">
<table class="table border">
<thead class="thead-light">
    <tr>

        <th scope="col">{{__('member/multi_lang.date')}}</th>
        <th scope="col">{{__('member/multi_lang.type')}}</th>
        <th scope="col">{{__('member/multi_lang.bonus_amt')}}</th>
        <th scope="col">{{__('member/multi_lang.status')}}</th>
        <th scope="col"></th>

    </tr>
</thead>
<tbody>
@if(Count($data['bonus_data'] ) > 0)
  @foreach(  $data['bonus_data'] as $bonus)
  <tr data-toggle="collapse" data-target="#bns{{$bonus->bonus_id}}" class="accordion-toggle">
      <td>{{date(config('sximo.cnf_date'),strtotime($bonus->date_added))}}  </td>
      <td>{{$bonus->bonus_name}}</td>
      <td >{{config('sximo.cnf_currencyname')}}{{$bonus->amount}}{{config('sximo.cnf_currencysuffix')}}</td>
      <td>{{ucfirst($bonus->status)}}</td>
      <td colspan="5">{{__('member/multi_lang.more_info')}} <i class="fa fa-angle-down"></i></td>
  </tr>

 <?php if(  isset($data['bonus_meta'][$bonus->bonus_id]) ) : ?>
		<tr>
			<td colspan="5" class="hiddenRow">
			<div id="bns{{$bonus->bonus_id}}" class="accordian-body p-3 collapse">
				<div class="row"><div class="col-md-12">
					<?php


					$wthMeta = $data['bonus_meta'][$bonus->bonus_id];
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
					<span>{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $firstMeta['change_time'])->diffForHumans()}}</span></time>
                    <div class="cbp_tmicon"><i class="fa fa-flag"></i></div>
                    <div class="cbp_tmlabel empty"> <span>{{__('member/multi_lang.history_status')}} - {{ucfirst($firstMeta['status'])}}</span> </div>
                </li>

				<?php foreach($withdrawMeta as $withDetail) {	?>

				 <li>
                    <time class="cbp_tmtime" datetime="{{$withDetail['change_time']}}">
					<span>{{date(config('sximo.cnf_date'),strtotime($withDetail['change_time']))}}</span>
					<span>{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $withDetail['change_time'])->diffForHumans()}}</span></time>
                    <div class="cbp_tmicon {{AppClass::getBgClassByStatus($withDetail['status']) }}"> <i class="fa fa-step-forward"></i></div>
                    <div class="cbp_tmlabel">
					 <span>{{__('member/multi_lang.history_status')}} - {{ucfirst($withDetail['status'])}}</span>
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
                        <span>{{__('member/multi_lang.history_status')}} - {{ucfirst($lastMeta['status'])}}</span>
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
		<div id="reftr{{$bonus->bonus_id}}" class="accordian-body p-3 collapse">
		{{__('member/multi_lang.sorry_found')}}!
		</div>
		</td>
		</tr>
		<?php endif;?>

  @endforeach
  @else
  <tr data-toggle="collapse" data-target="#demo13" class="accordion-toggle">
      <td colspan="5">{{__('member/multi_lang.sorry_found')}}!</td>
    </tr>
    @endif
	
</tbody>
</table>
</div>
{!!   $data['bonus_data']->render() !!}
