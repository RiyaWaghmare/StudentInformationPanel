<?php 

    if(!isset($_SESSION['Active'])){
        header("Location:?page=login");
    }

?>
<style>
    form{
        padding:20px;
    }
</style>
<div class="container">
    <h3 style="text-align:center;" class="heading">Marks portal</h3>
    <hr>
    <div class="form-group">
        <label>Select Semester: </label>
        <select id="sem" class="form-control">
            <option>SEM 1</option>
            <option>SEM 2</option>
            <option>SEM 3</option>
            <option>SEM 4</option>
            <option>SEM 5</option>
            <option>SEM 6</option>
            <option>SEM 8</option>
        </select>

    </div>
    <!-- <button id="add" style="margin-bottom:5px;" class="btn">Add Subject</button>
    <button id="delete" style="margin-bottom:5px;" class="btn">Delete Subject</button> -->
    <div id="marks-table"></div>
    <strong>CGPA: <span id="cgpa"></span></strong>
    <button id="submit-marks" style="margin-top:5px;" class="btn btn-success btn-block">Submit</button>
</div>
<script>

    var tableData=[
        {subject:"Enter Subject Name", marks:0, code:"Enter Subject Code"},
        {subject:"Enter Subject Name", marks:0, code:"Enter Subject Code"},
        {subject:"Enter Subject Name", marks:0, code:"Enter Subject Code"},
        {subject:"Enter Subject Name", marks:0, code:"Enter Subject Code"},
        {subject:"Enter Subject Name", marks:0, code:"Enter Subject Code"}
    ];

    var table = new Tabulator("#marks-table", {
        layout:"fitColumns",
        columns:[
            {title:"Subject Code", field:"code", sorter:"string", editor:true},
            {title:"Subject Name", field:"subject", sorter:"string", width:200, editor:true},
            {title:"Marks", field:"marks", sorter:"number", editor:true}        
        ],
        data:tableData,
        reactiveData:true,
        cellEdited:function(cell){
            var sum=0;
            tableData.forEach(data=>{
                sum=sum+parseInt(data.marks);
            });
            var percentage=sum/5;
            var cgpa=(percentage)/10;
            $("#cgpa").text(cgpa.toFixed(2));
        },
    });

    $("#add").click(()=>{
        tableData.push({subject:"", marks:0, code:""});
    });

    $("#delete").click(()=>{
        tableData.pop();
    });

    $("#submit-marks").click(()=>{
        const postData={
                redg_no:"<?php echo $_SESSION['redg_no']; ?>",
                cgpa:$("#cgpa").text()
            };

            $.ajax({
                type:"POST",
                url:"/project/utils/store-marks.php",
                data:`data=${JSON.stringify(postData)}`
            }).done(data=>{
                data=JSON.parse(data);

                if(data.code==="success"){
                    toastr.success("CGPA successfully updated", "Success")
                }else{
                    toastr.error("There was some error updating the CGPA", "Error");
                }

            }).fail(()=>{
                toastr.error("There was some error updating the CGPA", "Error");
            })
    })

</script>