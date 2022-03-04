<?php

 include_once("function.php");
 

 echo form_display_entries();
 
 function form_display_entries(){
 	
	// changes characters used in html to their equivalents, for example: < to &gt;
   global $wpdb;
   $table_certificate = $wpdb->prefix . 'contactform';
   $customPaged     = "";
   $db_query        = "SELECT * FROM $table_certificate";
   $total_certificate_query     = "SELECT COUNT(1) FROM (${db_query}) AS combined_table";
   $total             = $wpdb->get_var( $total_certificate_query );
   $items_per_page = 10;
   $page             = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
   $offset         = ( $page * $items_per_page ) - $items_per_page;
   $result         = $wpdb->get_results( $db_query."  LIMIT ${offset}, ${items_per_page}" );
   $result21         = $wpdb->get_results( $db_query );
   $totalPage         = ceil($total / $items_per_page);
   ?>

<div class="limiter">
		<div class="container-table100">
		<h1 style ="color:white;text-align:center;">Form Entries</h1>
			<div class="wrap-table100">
			<div class="header-column-box">
			<h3 style ="color:white;text-align:center;">Visa Application  <b>Entries</b></h3>
			</div>
			
			<div class="export-button">
			<form onsubmit="return false;"  action="" method="post" id="">
			<div class="btn-animate">   
             <input type="submit" onclick="exportTableToCSV('members.csv')"  name="export-submit"  value="Export Entries" /></div>
              </form>
			  </div>&nbsp;&nbsp;
			
		
				<div class="table100 ver1 m-b-110">
				
						<div class="table100 ver3 m-b-110">
						
					<table id="export" data-vertable="ver3">
						<thead>
							<tr class="row100 head">
								<th class="column100 column1" data-column="column1"><b><span style="font-family: Roboto;">Name</span></b></th>
								<th class="column100 column2" data-column="column2"><b><span style="font-family: Roboto;">Country of Origin</span></b></th>
								<th class="column100 column3" data-column="column3"><b><span style="font-family: Roboto;">Email address</span></b></th>
								<th class="column100 column5" data-column="column5"><b><span style="font-family: Roboto;">Phone number</span></b></th>
								<th class="exclude column100 column6" data-column="column6"><b><span style="font-family: Roboto;">Actions</span></b></th>
							</tr>
						</thead>
						<tbody>
						
						<?php
						
	                    foreach($result as $query){
		             global $wpdb;
		                $name = $query->name;
		                $nationality = $query->nationality;
						$email = $query->email;
						
						$phonenumber = $query->phonenumber;
						
		                

						
						?>
							<tr class="row100">
								<td class="column100 column1" data-column="column1"><span style="font-family: Roboto;"><?php echo $name; ?></span></td>
								<td class="column100 column2" data-column="column2"><span style="font-family: Roboto;"><?php echo $nationality; ?></span></td>
								<td class="column100 column3" data-column="column3"><span style="font-family: Roboto;"><?php echo $email; ?></span></td>
								<td class="column100 column4" data-column="column4"><span style="font-family: Roboto;"><?php echo $phonenumber; ?></span></td>
								<td class="exclude column100 column6" data-column="column6">
                                <a href="<?php echo admin_url('admin.php?page=update_formentry&id=' . $query->id.'&status=update'); ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="<?php echo admin_url('admin.php?page=update_formentry&id=' . $query->id.'&status=delete'); ?>" onclick="return confirm('Are you sure you want to delete?')" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
								
								</td>
							</tr>
                         <?php 

                        }
						?>
						</tbody>
					</table>
				</div>		
</div>
 <?php

   if($totalPage > 1){
   $paginate = paginate_links( array(
   'base' => add_query_arg( 'cpage', '%#%' ),
   'format' => '',
   'prev_text' => __('&laquo;'),
   'next_text' => __('&raquo;'),
   'total' => $totalPage,
   'current' => $page
    ));
   }
  $customPaged      =  '<div class="hint-text"><span style="color:white; font-family:Roboto;">Showing Page <b>'.$page.'</b> out of <b>'.$totalPage.'</b> Pages</span></div>';
   ?>
<div>
                <?php  echo $customPaged; ?>
                <ul class="pagination">
				<?php 
                   echo '<li class="page-item disabled">'. $paginate .'</li>';
					?>
                </ul>
            </div>
</div>
</div>
</div>
<?php
  
   }