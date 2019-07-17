
<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
        height: 300px;
}


</style>


<template>
    <div class="container">
      
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">

            <div class="widget-user-header text-white" style="background-image:url('./img/ten.jpg')">
                <h3 class="widget-user-username">Elizabeth Pierce</h3>
                <h5 class="widget-user-desc">Web Designer</h5>
              </div>

              <img class="img-circle" 
              src="" alt="User Avatar">

                <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
                </div> 
        </div>
    </div>
   
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.') 
    }
    }
</script>
    