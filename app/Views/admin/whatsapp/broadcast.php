<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>


<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between my-3">
    <h1 class="h3 mb-0 text-gray-800">Broadcast </h1>
  </div>
  <div class="row mb-3">
    <!-- Datatables -->
    <div class="col-lg-12">
      <div class="card mb-1">
        <div class="card-body">
          <div class="table-responsive table-bordered">
            <table class="table align-items-center   table-hover table-bordered" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>No of contact</th>
                  <th>Created Date</th>
                  <th>Sent</th>
                  <th>Failed</th>
                  <th>Replied</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Broadcast 1</td>
                  <td>50</td>
                  <td>15/02/2024 7:30</td>
                  <td>10</td>
                  <td>15</td>
                  <td>20</td>
                  <td>Edit</td>
                </tr>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    
<?=$this->endSection()?>