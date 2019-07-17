<template>
     <div class="container">
        <div class="row mt-5" v-if="$gate.isAdmin()">
                <div class="col-md-12">
                        <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Users Tables</h3>

                                <div class="card-tools">
                                    <button class="btn btn-success" @click="newModal">
                                        Add New 
                                    <i class="fas fa-user-plus fa-fw"></i></button>
                            
                                </div>
                </div>
              
            
                                        <!-- /.card-header -->
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>firstname</th>
                                                        <th>lastname</th>
                                                         <th>email</th>
                                                        <th>Type</th>
                                                        <th>Rigistered At</th>
                                                        <th>Modify</th>
                                                    </tr>

                                                        <tr v-for="user in users" :key="user.id">
                                                            <td>{{user.id}}</td>
                                                            <td>{{user.user_firstname}}</td>
                                                            <td>{{user.user_lastname}}</td>
                                                              <td>{{user.email}}</td>
                                                            <td>{{user.type | upText}}</td>
                                                            <td>{{user.created_at | myDate}}</td>
                                    
                                                            <td>
                                                                <a href="#" @click="editModal(user)">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>

                                                                /
                                            
                                                                <a href="#" @click=" deleteUser(user.id)">
                                                                    <i class="fa fa-trash text-red"></i>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                
                                
                    
                                                        </tbody>
                                                    </table>
                </div>
              <!-- /.card-body -->
                        </div>
                <!-- /.card --> 
          </div>
        </div>
        
   
                                        
                                        <!-- Modal -->
                                    <div class="modal fade" id="addNewLable" tabindex="-1" role="dialog" aria-labelledby="addNewLable" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" v-show="!editmode" id="addNewLable">Add New</h5>
                                            <h5 class="modal-title" v-show="editmode" id="addNewLable">Update Users Info</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                    <div class="modal-body">
                                        <div class="form-group">
                                             <label>user_firstname</label>
                                            <input v-model="form.user_firstname" type="text" name="user_firstname"
                                            placeholder="user_firstname"  class="form-control" :class="{ 'is-invalid': form.errors.has('user_firstname') }">
                                            <has-error :form="form" field="user_firstname"></has-error>
                                        </div>

                                    <div class="form-group">
                                             <label>user_lastname</label>
                                            <input v-model="form.user_lastname" type="text" name="user_lastname"
                                            placeholder="user_lastname"  class="form-control" :class="{ 'is-invalid': form.errors.has('user_lastname') }">
                                            <has-error :form="form" field="user_lastname"></has-error>
                                        </div>
                                    
                                    <div class="form-group">
                                        <label>email</label>
                                            <input v-model="form.email" type="text" name="email"
                                            placeholder="Email Address "  class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                    </div>

        
       
                                        <div class="form-group pt-2" >
                                    
                                            <select name="type" v-model="form.type" id="type"  placeholder="Type "  class="form-control" :class="{
                                                    'is-invalid': form.errors.has('type') }">
                                                <option value="" >Select User Role</option>
                                                <option value="admin" >Admin</option>
                                                <option value="user" >Standard User</option>
                                                <option value="author" >Author</option>
                                            </select>
                                                <has-error :form="form" field="type"></has-error>
                                        </div>

                                            
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input v-model="form.password" type="password" name="password"
                                                    placeholder="password "  class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                                    <has-error :form="form" field="password"></has-error>
                                            </div>
                                        

                                      </div>
                                        


                                        <div class="modal-footer">
                                            <button type="button " class="btn btn-danger" data-dismiss="modal">
                                                Close</button>
                                            <button v-show ="editmode" type="submit " class="btn btn-success ">Update</button>
                                            <button v-show ="!editmode" type="submit " class="btn btn-primary ">Create</button>
                                        </div>
                                    </form>
                                      
                                    </div>
                     </div>
                       
                                    </div>
                                
                                       
                                    

</div>
                                    
    
        
    

</template>

<script>
import { setInterval } from 'timers';
    export default {
        data(){

            
            return {
                editmode: false,
                users : {},
                form: new Form({
                    id:'',
                    user_firstname :'',
                    user_lastname :'',
                    email :'',
                    password :'',
                    type :'',
                })

            }
        },
        methods: {
            updateUser() {
              this.form.put('api/user/'+this.form.id)
              .then(() =>{


                  $('#addNewLable').modal('hide');
                      swal.fire(
                            'Updated!',
                            'Information has been updated',
                            'success'
                            )
                            this.$Progress.finish();
                             Fire.$emit('AfterCreated');
                  // success    
              })
              .catch(()=>{
                  this.$Progress.fail();
              });
              //console.log('Editing data');
            },

            editModal(user){
                this.editmode=true;
                this.form.reset();
                $('#addNewLable').modal('show');
                this.form.fill(user);
            },
             newModal(){
                 this.editmode=false;
                this.form.reset();
                $('#addNewLable').modal('show');
            },

            deleteUser(id){
                                
                swal.fire ({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    
                    if (result.value) {
                        //send request to the server
                        this.form.delete('api/user/'+id).then(()=>{
                          
                            swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            Fire.$emit('AfterCreated');
                        }).catch(()=>{

                            swal.fire ("Failed ! ","There was something wronge.","warning");
                        });
                    }
                })
            },
            loadUsers(){
                if(this.$gate.isAdmin){
                    axios.get("api/user").then(({ data }) => (this.users = data.data));
                }
            },

            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
                Fire.$emit('AfterCreated');
                $( '#addNewLable').modal('hide')

                toast({
                    type: 'success',
                    title: 'User Created in successfully'
                        })

                this.$Progress.finish();

            }
           
                 },
        created() {
            this.loadUsers();
            Fire.$on('AfterCreated',() =>{
                this.loadUsers();
            });
           // setInterval(() => this.loadUsers() ,3000);
        }
    }
</script>
