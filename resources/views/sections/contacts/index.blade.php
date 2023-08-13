@extends('layouts.app')
@section('title')
crm - contacts
@endsection
@section('content')    

    <link href="{{asset('assets/control_panel/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

    <div class="card card-custom gutter-b">
        <div class="p-3 mt-3">
            <form action="{{URL::current()}}" method="get">
                <div class="row  align-items-center">
                          
                    <div class="col-4 col-md-4 ">
                        <div class="form-group">
                            <input type="text" name="search" class="from form-control" placeholder="ابحث" >
                        </div>        
                    </div>       
                
                
                   
            
                    <div class="col-4 col-md-2">
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" value="ابحث">
                
                        </div> 
                    </div>
                </div>
                </form>  
        </div>
      
  
        <div class="card-header flex-wrap align-items-center py-3">

            
            <div class="card-title">
                
                <div class="d-flex align-items-center justify-content-between w-100">
                    <h3 class="card-label bold-text"> جهات الاتصال </h3>
                </div>
            </div>
            <div>
                <a href="{{route('contacts.create')}}" class="btn btn-primary">إضافة جهة اتصال</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-checkable yajra-datatable">
                <thead>
                    <tr>
                        <th></th>
                        <th>الإسم</th>
                        <th>الإيميل</th>
                        <th>رقم الهاتف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->phone}}</td>
                        <td>
                            <a href="{{route('contacts.edit',$contact)}}" class="btn btn-sm btn-outline-success"> <i class="fa-solid fa-pen-to-square px-0"></i> </a>
                            <button  class="btn btn-sm btn-outline-danger" onclick="deleteRow({{$contact->id}})" > 
                                <i class="fa-solid fa-trash-can px-0"></i>
                            </button>

                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $contacts->withQueryString()->links() }}
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        

     

        function deleteRow(id){
            swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف جهة الاتصال!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: {
                    confirm: "تأكيد",
                    cancel: "إغلاق",
                },
                closeOnConfirm: false,
                closeOnCancel: false
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/contacts/" + id,
                        type: 'delete',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (data){
                            toastr.clear();
                            if(data.errors){
                                data.errors.forEach(error => {
                                    toastr.error(error);
                                });
                            }else{
                                toastr.success('تم');
                                location.reload()

                            }
                        }
                    });
                    swal("تم حذف جهة الاتصال بنجاح", {
                    icon: "success",
                    });
                }
            });
        }

    </script>
@endsection

