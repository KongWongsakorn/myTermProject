@extends('layout')

@section('content')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- <title>Test</title> --}}
        {{-- add bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>
    <body>
        <body>
            {{-- lets create a view of a table with list of cars --}}
            <div class="container">
                
                <div class="card">
                    <div class="card-header">จัดการชนิดการลา </div>
                    {{-- these two spans will display flash messages --}}
                    <span class="alert alert-success" id="alert-success" style="display: none;"></span>
                    <span class="alert alert-danger" id="alert-danger" style="display: none;"></span>
                    {{-- <form class="form-inline my-2 my-lg-0" name="qp" action="index.php" method="GET">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" name="q">
                      </form> --}}
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ชนิดการลาที่</th>
                                    <th>ชื่อชนิดการลา</th>
                                    <th>จำนวนครั้งที่ลาได้</th>
                                   
                                    <th colspan="5">แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- pass data from database here --}}
                                @if (count($all_typeleave) > 0)
                                    @foreach ($all_typeleave as $itemtypeleave)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$itemtypeleave->name}}</td>
                                            <td>{{$itemtypeleave->number}}</td>
    
                                            <td><button class="btn btn-primary btn-sm editBtn" data-id="{{$itemtypeleave->id}}" data-name="{{$itemtypeleave->name}}" data-num="{{$itemtypeleave->number}}"  data-bs-toggle="modal" data-bs-target="#editModal">edit</button></td>
                                            
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No Data Found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    
            <!-- edit car Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">edit typeleave </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      {{-- create a form here.. --}}
                      <form id="editTypeleaveForm">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="">name</label>
                            <input type="text" name="name" class="form-control" id="name">
                            <span id="name_error" class="text-danger"></span>
                            <label for="">number</label>
                            <input type="int" name="number" class="form-control" id="number">
                            <span id="name_error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary editButton">Save changes</button>
                    </div>
                    {{-- this is to make sure the save changes button is within form --}}
                </form>
                  </div>
                </div>
              </div>
          <script>
                $(document).ready(function(){
                    $('#addSubcategoryForm').submit(function(e){
                        e.preventDefault();
                        let formData = $(this).serialize();
                        $.ajax({
                            url: '{{ route("addSubcategory")}}',
                            data: formData,
                            contentType: false,
                            processData:false,
                            beforeSend:function(){
                                $('.addBtn').prop('disabled', true);
                            },
                            complete: function(){
                                $('.addBtn').prop('disabled', false);
                            },
                            success: function(data){
                                if(data.success == true){
                                    // this is the correct way to close modal
                                    $('#addModal').modal('hide');
                                    printSuccessMsg(data.msg);
                                    var reloadInterval = 5000; //page reload delay duration
                                // Function to reload the whole page
                                function reloadPage() {
                                    location.reload(true); // Pass true to force a reload from the server and not from the browser cache
                                }
                                // Set an interval to reload the page after the specified time
                                var intervalId = setInterval(reloadPage, reloadInterval);
                                }else if(data.success == false){
                                    printErrorMsg(data.msg);
                                }else{
                                    printValidationErrorMsg(data.msg);
                                }
                            }
                        });
                        return false;
                        
                    });

                    // edit car functionality..
                    $('.editBtn').on('click',function(){
                        // get all car data that we passed on the edit button
                        var id = $(this).attr('data-id');
                        var name = $(this).attr('data-name');
                        var number = $(this).attr('data-num');
                       
        
                        // then display them in a edit form
                        $('#name').val(name);
                        $('#number').val(number);
                       
                        // the car id will be hidden on the edit form so assign it as hidden input
                        $('#id').val(id);
                       
                    });
        
                     // then submit the form
                     $('#editTypeleaveForm').submit(function(e){
                            e.preventDefault();
                            let formData = $(this).serialize();
                            $.ajax({
                                url: '{{ route("editTypeleave")}}',
                                data: formData,
                                contentType: false,
                                processData:false,
                                beforeSend:function(){
                                    $('.editButton').prop('disabled', true);
                                },
                                complete: function(){
                                    $('.editButton').prop('disabled', false);
                                },
                                success: function(data){
                                    if(data.success == true){
                                        // this is the correct way to close modal
                                        $('#editModal').modal('hide');
                                        location.reload(5000);
                                        printSuccessMsg(data.msg);
                                        
                                        var reloadInterval = 5000; //page reload delay duration
                                        // Function to reload the whole page
                                        function reloadPage() {
                                        location.reload(true); // Pass true to force a reload from the server and not from the browser cache
                                         }
                                    // Set an interval to reload the page after the specified time
                                    var intervalId = setInterval(reloadPage, reloadInterval);
                                    }else if(data.success == false){
                                        printErrorMsg(data.msg);
                                    }else{
                                        printValidationErrorMsg(data.msg);
                                    }
                            }
                            });
                        });
                    // the three functions for flash messages
                    function printValidationErrorMsg(msg){
                        $.each(msg, function(field_name, error){
                            // console.log(field_name,error);
                            // this will find a input id for error lets create this
                            $(document).find('#'+field_name+'_error').text(error);
                        });
                        }
                        function printErrorMsg(msg){
                        $('#alert-danger').html('');
                        $('#alert-danger').css('display','block');
                        $('#alert-danger').append(''+msg+'');
                        }
                        function printSuccessMsg(msg){
                        $('#alert-success').html('');
                        $('#alert-success').css('display','block');
                        $('#alert-success').append(''+msg+'');
                        // if form successfully submitted reset form
                        document.getElementById('addSubcategoryForm').reset();
                        }
                });
          </script>
        
        
        
        </body>
    
@endsection 
