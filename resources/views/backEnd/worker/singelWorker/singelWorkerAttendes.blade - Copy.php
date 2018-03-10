@extends('backEnd.worker.singelWorkerContent')

@section('tabContent')

<?php 

$thisMonth = date(' F Y', mktime(0,0,0, $month, 1, $year ));
$totaldays = date('t', mktime(0,0,0,$month,1,$year));

$today = date('d');
$currentMonth = date('m');
$currentYear = date('Y');

$pvrMonth= date('m',mktime(0, 0, 0, $month-1, 1, $year));
$nextMonth= date('m',mktime(0, 0, 0, $month+1, 1, $year));


?>

	<!-- Calendar -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Employee attendance Table<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					{{--<li><a data-action="close"></a></li>--}}
				</ul>
			</div>
		</div>
		
		<div class="panel-body">
			<div class=" fc fc-unthemed fc-ltr">
				<div class="fc-toolbar fc-header-toolbar">

					<div class="fc-left">
						<div class="fc-button-group">

							
							@if($pvrMonth == 1)
								<?php $yDiff = $currentYear - $year; $yDiff = $yDiff+1; $pvrYear = $currentYear-$yDiff; $date = new DateTime($singelworker->created_at);
                                    $jMonth = date_format($date, 'm'); $jYr = date_format($date, 'm');?>
                                @if($jMonth<=$pvrMonth && $jYr<=$pvrYear)
								<a  href="{{ route('attendes',['id'=>$id, 'month'=>$pvrMonth,'year'=>$pvrYear]) }}" class="fc-prev-button fc-button fc-state-default fc-corner-left" >
									<span class="fc-icon fc-icon-left-single-arrow"></span>
								</a>
                                @else
                                    <a  href="#" disabled class="fc-prev-button fc-button fc-state-default fc-corner-left" >
                                        <span class="fc-icon fc-icon-left-single-arrow"></span>
                                    </a>
                                @endif
							@else
								<a href="{{ route('attendes',['id'=>$id, 'month'=>$pvrMonth,'year'=>$year]) }}" class="fc-prev-button fc-button fc-state-default fc-corner-left" >
									<span class="fc-icon fc-icon-left-single-arrow"></span>
								</a>
							@endif

							@if($nextMonth == 12 && $currentMonth != $month)
								<?php $nextYear =$year+1; ?>
								<a href=" {{ route('attendes',['id'=>$id, 'month'=>$nextMonth,'year'=>$nextYear]) }}" class="fc-next-button fc-button fc-state-default fc-corner-right" >
									<span class="fc-icon fc-icon-right-single-arrow"></span>
								</a>
							@elseif( $currentMonth == $month )
								<a href=" {{ route('attendes',['id'=>$id, 'month'=>$month,'year'=>$year]) }}" class="fc-next-button fc-button fc-state-default fc-corner-right" >
									<span class="fc-icon fc-icon-right-single-arrow"></span>
								</a>
							@else
								<a href=" {{ route('attendes',['id'=>$id, 'month'=>$nextMonth,'year'=>$year]) }}" class="fc-next-button fc-button fc-state-default fc-corner-right" >
									<span class="fc-icon fc-icon-right-single-arrow"></span>
								</a>
							@endif

						</div>
					</div>
					
					<div class="fc-center col-md-5 col-md-offset-1">
						<h2>{{ $thisMonth }}</h2>
					</div>
					<div class="fc-clear"></div>
				</div>
				<div class="fc-view-container">
					<div class="fc-view fc-month-view fc-basic-view">
						<table >
							<thead class="fc-head">
								<tr>
									<td class="fc-head-container fc-widget-header">
										<div class="fc-row fc-widget-header" style="border-right-width: 1px; margin-right: 16px;">
											<table>
												<thead>
													<tr>
														
														<th class="fc-day-header fc-widget-header fc-sun">
															<span>Sun</span>
														</th>
														<th class="fc-day-header fc-widget-header fc-mon">
															<span>Mon</span>
														</th>
														<th class="fc-day-header fc-widget-header fc-tue">
															<span>Tue</span>
														</th>
														<th class="fc-day-header fc-widget-header fc-wed">
															<span>Wed</span>
														</th>
														<th class="fc-day-header fc-widget-header fc-thu">
															<span>Thu</span>
														</th>
														<th class="fc-day-header fc-widget-header fc-fri">
															<span>Fri</span>
														</th>
														<th class="fc-day-header fc-widget-header fc-sat">
															<span>Sat</span>
														</th>

													</tr>
												</thead>
											</table>
										</div>
									</td>
								</tr>
							</thead>
							<tbody class="fc-body">
								<tr>
									<td class="fc-widget-content">
										<div class="fc-scroller fc-day-grid-container" style="overflow-x: hidden; overflow-y: scroll; height: 444px;">
											<div class="fc-day-grid fc-unselectable">
												<div class="fc-row fc-week fc-widget-content">
													

													<div class="fc-content-skeleton">
														<table >
														<?php $day= 1; $days= 1; ?>
														@for($i=0; $i<=$totalWeeks; $i++)
															<thead>
																<tr>
																
																@for($j=0; $j<'7' && $day<=$totaldays ; $j++)

																<?php $dayValue =date('w',mktime(0, 0, 0, $month, $day, $year));?>
																	@if( $j== $dayValue )
																		<td class="fc-day-top fc-sat fc-past" >
																			<span class="fc-day-number"> {{ $day }} </span>
																		</td>
																	<?php $day++ ;?>
																	@else
																		<td class="fc-day-top fc-sun fc-other-month fc-past">
																			<span class="fc-day-number"></span>
																		</td>
																	@endif
																
																@endfor
																</tr>
															</thead>


															<tbody>
																<tr>
																
																@for($k=0; $k<'7' && $days<=$totaldays; $k++)

																<?php 
																	$dayValue =date('w',mktime(0, 0, 0, $month, $days, $year)); 
																	$date_diff = date_diff(date_create($singelworker->created_at),date_create($year.'-'.$month.'-'.$days));

																	if($days<'10'){ $date = '0'.$days; }else{ $date = $days; }
																	if($month<'10'){ $cMonth='0'.$month; }else{ $cMonth = $month; }

																	$dates = $year.'-'.$cMonth.'-'.$date; 	
																?>
																	@if($k== $dayValue)

																		@if( $currentMonth == $month )
		
																			@if($days < $today && $date_diff->format('%a') >0 )
																				<?php $attendes =App\Attendance::where('UserId', $id)->whereDate('AttendanceDate', $dates)->first(); ?>

																				@if(!is_null($attendes))
																					<td class="fc-event-container" >
																						<a class="fc-day-grid-event fc-h-event fc-event bg-success fc-start fc-end fc-draggable fc-resizable">
																							<div class="fc-content">
																								<span class="fc-title ">Present</span>
																							</div>
																							<div class="fc-resizer fc-end-resizer"></div>
																						</a>
																					</td>
																				@else
																					<td class="fc-event-container">
																						<a class="fc-day-grid-event fc-h-event fc-event bg-danger fc-start fc-end fc-draggable fc-resizable">
																							<div class="fc-content"> 
																								<span class="fc-title ">Absent</span>
																							</div>
																							<div class="fc-resizer fc-end-resizer"></div>
																						</a>
																					</td>
																				@endif

																			@else
																				<td class="fc-event-container">
																					<div style="height:50px;"></div>
																				</td>
																			@endif
																		
																			
																		@else
																			<?php $attendes =App\Attendance::where('UserId', $id)->whereDate('AttendanceDate', $dates)->first(); ?>

																			@if(!is_null($attendes) && $date_diff->format('%a') >0)
																				<td class="fc-event-container">
																					<a class="fc-day-grid-event fc-h-event bg-success fc-event fc-start fc-end fc-draggable fc-resizable">
																						<div class="fc-content"> 
																							<span class="fc-title ">Present</span>
																						</div>
																						<div class="fc-resizer fc-end-resizer"></div>
																					</a>
																				</td>
																			@else
																				<td class="fc-event-container">
																					<a class="fc-day-grid-event fc-h-event fc-event bg-danger fc-start fc-end fc-draggable fc-resizable">
																						<div class="fc-content"> 
																							<span class="fc-title ">Absents</span>
																						</div>
																						<div class="fc-resizer fc-end-resizer"></div>
																					</a>
																				</td>
																			@endif

																		@endif

																		<?php $days++ ;?>
																	@else
																		<td></td>
																	@endif
																
																@endfor
																	
																</tr>
															</tbody>

														@endfor
														</table>
													</div>


												</div>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<!-- /calendar -->



@endsection