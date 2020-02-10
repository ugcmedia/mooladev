<div class="m-t" style="padding-top:25px;">
    <div class="row m-b-lg animated fadeInDown delayp1 text-center">
        <h3> {{ $pageTitle }} <small> {{ $pageNote }} </small></h3>
        <hr />
    </div>
</div>
<div class="m-t">
	<div class="table-responsive" >

		<table class="table table-striped table-bordered" >
			<tbody>


					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Id', (isset($fields['vendor_id']['language'])? $fields['vendor_id']['language'] : array())) }}</td>
						<td>{{ $row->vendor_id}} </td>

					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Code', (isset($fields['vendor_code']['language'])? $fields['vendor_code']['language'] : array())) }}</td>
						<td>{{ $row->vendor_code}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Email', (isset($fields['email']['language'])? $fields['email']['language'] : array())) }}</td>
						<td>{{ $row->email}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Va Salt', (isset($fields['va_salt']['language'])? $fields['va_salt']['language'] : array())) }}</td>
						<td>{{ $row->va_salt}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Name', (isset($fields['vendor_name']['language'])? $fields['vendor_name']['language'] : array())) }}</td>
						<td>{{ $row->vendor_name}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Va Hash', (isset($fields['va_hash']['language'])? $fields['va_hash']['language'] : array())) }}</td>
						<td>{{ $row->va_hash}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Va Pass', (isset($fields['password']['language'])? $fields['password']['language'] : array())) }}</td>
						<td>{{ $row->password}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Va Token', (isset($fields['va_token']['language'])? $fields['va_token']['language'] : array())) }}</td>
						<td>{{ $row->va_token}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Email Verified', (isset($fields['email_verified']['language'])? $fields['email_verified']['language'] : array())) }}</td>
						<td>{{ $row->email_verified}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Joined', (isset($fields['joined']['language'])? $fields['joined']['language'] : array())) }}</td>
						<td>{{ $row->joined}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>

					</tr>

			</tbody>
		</table>



	</div>
</div>
