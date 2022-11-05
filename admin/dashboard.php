<?php
session_start();
include '../functions/sql_conn.php';

if (!isset($_SESSION['logged_in'])) {
	session_destroy();
	header('location: index.php');
	exit();
}

// Fetching all data

$sqlQueries = [
	"SELECT `value` FROM `user_info` WHERE `description` = 'overview'",
	"SELECT `additional_value` FROM `user_info` WHERE `description` = 'description'",
	"SELECT `additional_value` FROM `user_info` WHERE `description` = 'platforms'"
];

$data = [];

foreach ($sqlQueries as $k => $v) {
	$query = mysqli_query($mysqli, $v);
	$data[$k] = mysqli_fetch_all($query)[0];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
	<!-- JQuery -->
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	<!-- Popper -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- Style -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Fontawesome -->
	<script src="https://kit.fontawesome.com/a2501cd80b.js" crossorigin="anonymous"></script>

	<title>Admin | Portfolio</title>

	<style>
		.content {
			padding: 10% !important;
		}

		textarea {
			width: 100%;
		}

		td img {
			width: 10rem;
		}
	</style>
</head>

<body>
	<div class="accordion content" id="accordionExample">
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					Home, About Me, Contact Buttons
				</button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
				<div class="accordion-body">
					<div style="text-align: center">
						<!-- TO-DO: Set modal IDs -->
						<button type="button" data-bs-toggle="modal" data-bs-target="#changeOverview" class="btn btn-outline-dark">Change Overview(Home)</button>
						<button type="button" data-bs-toggle="modal" data-bs-target="#changeDescription" class="btn btn-outline-dark">Change Description(About Me)</button>
						<button type="button" data-bs-toggle="modal" data-bs-target="#changeCV" class="btn btn-outline-dark">Change CV File</button>
						<button type="button" data-bs-toggle="modal" data-bs-target="#viewPlatform" class="btn btn-outline-dark">Change Platforms (Contact)</button>
					</div>
				</div>
			</div>
		</div>

		<div class="accordion-item">
			<h2 class="accordion-header" id="headingTwo">
				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
					Visitor Inquiries
				</button>
			</h2>
			<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
				<div class="accordion-body">
					<div class="table-responsive custom-table-responsive">
						<table class="table custom-table">
							<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Name</th>
									<th scope="col">Email</th>
									<th scope="col">Quick Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sqlQuery = "SELECT * FROM `visitor_query` WHERE `status` = 0 ORDER BY `id` DESC";
								$resultQuery = mysqli_query($mysqli, $sqlQuery);

								if (mysqli_num_rows($resultQuery) > 0) {
									$dataQuery = mysqli_fetch_all($resultQuery);

									foreach ($dataQuery as $k => $v) {
										echo <<<HTML
                        <tr scope="row">
                          <td>
                            {$v[0]}
                          </td>
                          <td>{$v[1]}</td>
                          <td>
                            <a href="mailto:{$v[2]}">{$v[2]}</a>
                          </td>
                          <td>
                            <button type="button" onclick="fetchMessage({$v[0]})" data-bs-toggle="modal" data-bs-target="#viewMessage" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fa-solid fa-eye"></i></button>
                            <button type="button" onclick="markAsRed({$v[0]})" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as Read"><i class="fa-solid fa-envelope-circle-check"></i></button>
                          </td>
                          <tr class="spacer">
                            <td colspan="100"></td>
                          </tr>
                        </tr>
                      HTML;
									}
								} else {
									echo <<<HTML
                      <tr><th colspan=5>No data found</th></tr>
                    HTML;
								}
								?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="accordion-item">
			<h2 class="accordion-header" id="headingThree">
				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
					Certificates
				</button>
			</h2>
			<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
				<div class="accordion-body">
					<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#updateCertInfo">Add Certificate</button><br><br>
					<div class="table-responsive custom-table-responsive">
						<table class="table custom-table">
							<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Title</th>
									<th scope="col">Description</th>
									<th scope="col">Date</th>
									<th scope="col">File</th>
									<th scope="col">Quick Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sqlCerts = "SELECT * FROM `certificates`";
								$resCerts = mysqli_query($mysqli, $sqlCerts);

								if (mysqli_num_rows($resCerts) > 0) {
									$dataCerts = mysqli_fetch_all($resCerts);

									foreach ($dataCerts as $k => $v) {
										$desc = (strlen($v[2]) > 100) ? substr($v[2],0,97).'...' : $v[2];
										$dateCert = date("m/d/Y", $v[3]);
										echo <<<HTML
											<tr scope="row">
											<td>
												{$v[0]}
											</td>
											<td>{$v[1]}</td>
											<td>
												<small class="d-block">{$desc}</small>
											</td>
											<td>{$dateCert}</td>
											<td><a href="../assets/certificates/{$v[0]}.png"><i class="fa-solid fa-image"></i></a></td>
											<td>
												<button type="button" onclick="openCertEdit({$v[0]});"class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa-solid fa-pen"></i></button>
												<button type="button" onclick="removeCert({$v[0]});"class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><i class="fa-solid fa-trash"></i></button>
											</td>
											</tr>
											<tr class="spacer">
											<td colspan="100"></td>
											</tr>
										HTML;
									}
								} else {
									echo <<<HTML
									<tr><th colspan=6>No data found</th></tr>
									HTML;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="accordion-item">
			<h2 class="accordion-header" id="headingFour">
				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
					Projects
				</button>
			</h2>
			<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
				<div class="accordion-body">
					<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#updateProject">Add Project</button><br><br>
					<div class="table-responsive custom-table-responsive">
						<table class="table custom-table">
							<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Title</th>
									<th scope="col">Description</th>
									<th scope="col">Created At</th>
									<th scope="col">Members</th>
									<th scope="col">Logo</th>
									<th scope="col">Quick Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sqlProj = "SELECT * FROM `projects`";
								$resProj = mysqli_query($mysqli, $sqlProj);

								if (mysqli_num_rows($resProj) > 0) {
									$dataProj = mysqli_fetch_all($resProj);

									foreach ($dataProj as $k => $v) {
										echo <<<HTML
										<tr scope="row">
										<td>
											{$v[0]}
										</td>
										<td>{$v[1]}</td>
										<td>
											<small class="d-block">{$v[2]}</small>
										</td>
										<td>{$v[3]}</td>
										<td>
										HTML;

										$memberJson = json_decode($v[4]);
										foreach($memberJson as $k => $i) {
											echo $i."<br>";
										}

										echo <<<HTML
										</td>
										<td>
											<a href="../assets/projects/{$v[0]}.png"><i class="fa-solid fa-image"></i></a>
										</td>
										<td>
											<button type="button" onclick="openAddFile({$v[0]});" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Additional File"><i class="fa-solid fa-file-image"></i></button>
											<button type="button" onclick="openEditProj({$v[0]});" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa-solid fa-pen"></i></button>
											<button type="button" onclick="removeProj({$v[0]});" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><i class="fa-solid fa-trash"></i></button>
										</td>
										</tr>
										<tr class="spacer">
										<td colspan="100"></td>
										</tr>
										HTML;
									}
								} else {
									echo <<<HTML
									<tr><th colspan=7>No data found</th></tr>
									HTML;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal modal-lg fade" id="changeOverview" tabindex="-1" aria-labelledby="changeOverviewLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update Overview</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<textarea name="overview" id="overview" cols="30" rows="10"><?php echo $data[0][0]; ?></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="updateOverview();">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal modal-lg fade" id="changeDescription" tabindex="-1" aria-labelledby="changeDescriptionLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update Description</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<textarea name="description" id="description" cols="30" rows="10"><?php echo $data[1][0]; ?></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="updateDescription();">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal modal fade" id="changeCV" tabindex="-1" aria-labelledby="changeCVLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update CV</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label for="formFile" class="form-label">Upload your CV here</label>
						<input class="form-control" type="file" id="cv">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="updateCV();">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal modal-xl fade" id="viewPlatform" tabindex="-1" aria-labelledby="viewPlatformLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">View Platforms</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<table class="table custom-table">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Platform</th>
								<th scope="col">Link</th>
								<th scope="col">Quick Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$platforms = json_decode($data[2][0], true);
							// var_dump($platforms);
							foreach ($platforms as $k => $v) {
								echo <<<HTML
                    <tr scope="row">
                      <td>
                        {$k}
                      </td>
                      <td>{$v["title"]}</td>
                      <td><a href="{$v['url']}" target="_blank">{$v['url']}</a></td>
                      <td>
                        <button type="button" onclick="updatePlatform('{$k}');" class="btn btn-outline-dark" title="Edit"><i class="fa-solid fa-pen"></i></button>
                      </td>
                    </tr>
                    <tr class="spacer">
                      <td colspan="100"></td>
                    </tr>
                  HTML;
							}
							?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatePlatform" onclick="addPlatform();">Add Platform</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="updatePlatform" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Create/Update Platform</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="platformContainer">
					<form id="platformForm">
						<div class="mb-3">
							<label for="platformName" class="form-label">Platform</label>
							<input type="text" class="form-control" id="platformName" name="platformName" placeholder="Platform">
						</div>
						<div class="mb-3">
							<label for="platformIcon" class="form-label">FontAwesome Icon</label>
							<input type="text" class="form-control" id="platformIcon" name="platformIcon" placeholder="<i>">
						</div>
						<div class="mb-3">
							<label for="platformURL" class="form-label">URL</label>
							<input type="text" class="form-control" id="platformURL" name="platformURL" placeholder="example.com">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="savePlatform();">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Visitors -->

	<div class="modal modal-lg fade" id="viewMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">View Message</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="messageContainer">
					<h5>Name</h5>
					<p></p>
					<br>
					<h6>Email</h6>
					<a href="mailto:"></a>
					<br>
					<h6>Message</h6>
					<p></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Certificate -->

	<div class="modal fade" id="updateCertInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Upload/Update Certificate</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="platformContainer">
					<form id="certForm" action="functions/addCertificate.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="-1">
						<div class="mb-3">
							<label for="formFile" class="form-label">Upload your Certificate here</label>
							<input class="form-control" type="file" id="certFile" name="certFile">
						</div>
						<div class="mb-3">
							<label for="certTitle" class="form-label">Title</label>
							<input type="text" class="form-control" id="certTitle" name="certTitle" placeholder="Best in Memes">
						</div>
						<div class="mb-3">
							<label for="certDescription" class="form-label">Description</label>
							<textarea type="text" class="form-control" id="certDescription" name="certDescription" placeholder="Lorem Ipsum"></textarea>
						</div>
						<div class="mb-3">
							<label for="certDate" class="form-label">Date</label>
							<input type="text" class="form-control" id="certDate" name="certDate" placeholder="MM/DD/YYYY">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="$('#certForm').submit();">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Project -->

	<div class="modal modal-xl fade" id="viewAdditional" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">View Additional Files</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<table class="table custom-table">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Link</th>
								<th scope="col">Quick Actions</th>
							</tr>
						</thead>
						<tbody id="projAddTable">
							<tr scope="row">
								<td>
									0
								</td>
								<td><a href="">Link</a></td>
								<td>
									<button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa-solid fa-pen"></i></button>
								</td>
							</tr>
							<tr class="spacer">
								<td colspan="100"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="addMoreFiles();">Add File</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="addFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add File to Project</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="additionalFileForm" action="functions/addProjFile.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" id="addFileID" value="-1">
						<input type="hidden" name="projectID" id="projectID">
						<div class="mb-3">
							<label for="formFile" class="form-label">Upload your Project Screenshot here</label>
							<input class="form-control" type="file" name="ss">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="$('#additionalFileForm').submit()">Add File</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="updateProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Create/Update Project</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="projectInfForm" action="functions/saveProject.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="-1">
						<div class="mb-3">
							<label for="projLogo" class="form-label">Upload Project Logo here</label>
							<p class="fs-6">Leave blank if doesn't need to be updated. (For updates)</p>
							<input class="form-control" type="file" name="projLogo" id="projLogo">
						</div>
						<div class="mb-3">
							<label for="projName" class="form-label">Title</label>
							<input type="text" class="form-control" id="projName" name="projName" placeholder="Best in Memes">
						</div>
						<div class="mb-3">
							<label for="projDesc" class="form-label">Description</label>
							<input type="text" class="form-control" id="projDesc" name="projDesc" placeholder="Lorem Ipsum">
						</div>
						<div class="mb-3">
							<label for="projDate" class="form-label">Date</label>
							<input type="text" class="form-control" id="projDate" name="projDate" placeholder="MM/DD/YYYY">
						</div>
						<div class="mb-3">
							<label for="projLead" class="form-label">Lead</label>
							<input type="text" class="form-control" id="projLead" name="projLead" placeholder="Juan Dela Cruz">
						</div>
						<div class="mb-3" id="membersInput">
							<label for="projMember" class="form-label">Member(s)</label>
							<p class="fs-6">If to be removed, leave the field blank</p>
							<input type="text" class="form-control" name="projMember[]" placeholder="Member">
						</div>
						<button type="button" class="btn btn-secondary" onclick="addMember();">Add Member Field</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="$('#projectInfForm').submit();">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<script src="js/main.js"></script>
	<script>
		function updatePlatform(id) {
			$("#viewPlatform").modal('hide');
			$("#updatePlatform").modal('show');
			$.ajax({
				url: "functions/fetchPlatformInfo.php",
				type: "POST",
				data: {
					"id": id
				},
				success: function(data) {
					$("#platformContainer").html(data);
				}
			});
		}

		function savePlatform() {
			$.ajax({
				url: "functions/savePlatform.php",
				type: "POST",
				data: $("#platformForm").serialize(),
				success: function(data) {
					$("#updatePlatform").modal('hide');
				}
			});
		}

		function addMember() {
			$("#membersInput").append('<input type="text" class="form-control" name="projMember[]" placeholder="Member">');
		}

		function openAddFile(id) {
			$.ajax({
				url:"functions/fetchAddFiles.php",
				type: "POST",
				data: {
					"id":id
				},
				success: function(data) {
					$("#viewAdditional").modal("show");
					$("#projAddTable").html(data);
				}
			});
		}

		function addMoreFiles() {
			id = $("#id_addFiles").val();
			$("#projectID").val(id);
			$("#viewAdditional").modal("hide");
			$("#addFile").modal("show");
		}

		function fetchMessage(id) {
			$.ajax({
				url: "functions/fetchMessage.php",
				type: "POST",
				data: {
					"id": id
				},
				success: function(data) {
					$("#messageContainer").html(data);
					$("#viewMessage").modal("show");
				}
			});
		}

		function markAsRed(id) {
			$.ajax({
				url: "functions/markAsRed.php",
				type: "POST",
				data: {
					"id": id
				},
				success: function(tmp) {
					location.reload();
				}
			});
		}

		function openCertEdit(id) {
			$.ajax({
				url: "functions/fetchCertificate.php",
				type: "POST",
				data: {
					"id": id
				},
				success: function(data) {
					$("#certForm").html(data);
					$("#updateCertInfo").modal("show");
				}
			});
		}

		function removeCert(id) {
			if(confirm("Do you wish to remove this certificate? This process is irreversible.")) 
				$.ajax({
					url: "functions/delCert.php",
					type: "POST",
					data: {
						"id": id
					},
					success: function(tmp) {
						location.reload();
					}
				});
		}

		function editFile(id) {
			id = $("#id_addFiles").val();
			$("#projectID").val(id);
			$("#addFileID").val(id);
			$("#addFile").modal("show");
		}

		function openEditProj(id) {
			$.ajax({
				url: "functions/fetchProject.php",
				type: "POST",
				data: {
					"id": id
				},
				success: function(data) {
					$("#projectInfForm").html(data);
					$("#updateProject").modal("show");
				}
			});
		}

		function removeProj(id) {
			if(confirm("Do you wish to remove this project? This process is irreversible.")) 
				$.ajax({
					url: "functions/delProj.php",
					type: "POST",
					data: {
						"id": id
					},
					success: function(tmp) {
						console.log(tmp)
						// location.reload();
					}
				});
		}
	</script>
</body>

</html>