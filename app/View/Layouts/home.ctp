<?php
	if(!AuthComponent::user('authenticated') && AuthComponent::user('id') != '20'){
		 ?>
?><div class="box span4">
	<div class="box-header well">
		<h2><i class="icon-user"></i> Connect to GoToWebinar</h2>
	</div>
	<div class="box-content">
		<p>Before you can do anything with this app, you must connect this account with your GoToWebinar account.</p>
		<a href="/users/edit/<?php echo AuthComponent::user('id'); ?>"><button class="btn btn-large btn-success">Go</button></a>
	</div>
</div>
<?php
}
?>
<?php if(AuthComponent::user('id') != '20'){ ?>
<div class="box span4">
	<div class="box-header well">
		<h2><i class="icon-user"></i> Get Registration URL</h2>
	</div>
	<div class="box-content">
		<p>This page will give you the URL for you to send the HTTP Post in Infusionsoft for your webinar as well as the post variables.</p>
		<a href="/webinars/registration"><button class="btn btn-large btn-success">Go</button></a>
	</div>
</div>
<div class="box span4">
	<div class="box-header well">
		<h2><i class="icon-tags"></i> Tag Attendees</h2>
	</div>
	<div class="box-content">
		<p>Get a list of all of the attendees for a specific webinar or session and apply a Tag on their contact record in Infusionsoft.</p>
		<a href="/webinars/tags"><button class="btn btn-large btn-success">Go</button></a>
	</div>
</div>
<?php if(AuthComponent::user('id') == '16' || AuthComponent::user('id') == 17){ ?> 
<div class="box span4">
	<div class="box-header well">
		<h2><i class="icon-th-list"></i> Get Attendance Data</h2>
	</div>
	<div class="box-content">
		<p>Check the attendance stats for each of your webinars or get a cumulative total then tag attendees based on the data.</p>
		<a href="/webinars/data"><button class="btn btn-large btn-success">Go</button></a>
	</div>
</div>
<?php } ?>
<div class="box span4">
	<div class="box-header well">
		<h2><i class="icon-time"></i> Get iCal URLs</h2>
	</div>
	<div class="box-content">
		<p>Get the URLs you can use in your HTML emails for customers to download a link to add the webinar to their calendar with an iCal file.</p>
		<a href="/webinars/calendar"><button class="btn btn-large btn-success">Go</button></a>
	</div>
</div>
<? }
else {
 ?>
 <div class="box span4">
	<div class="box-header well">
		<h2><i class="icon-time"></i> Process Orientation Attendees</h2>
	</div>
	<div class="box-content">
		<p>Complete the goal in the tt135.infusionsoft.com application for Orientation Webinar attendees</p>
		<a href="/webinars/attendees"><button class="btn btn-large btn-success">Go</button></a>
	</div>
</div>
 <? } ?>