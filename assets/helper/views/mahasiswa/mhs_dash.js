$(function(){
    $.ajax({
        url:base_url("Mahasiswa/CekProgress"),
        type:'get',
        contentType: false,
        processData: false,
        success: function(response){
            if(response!=null){
                var progress_mhs = parseInt(response);
                setDashProgress(progress_mhs);
            }else{
                $('#heading').empty();
            }
            
        }
      });
    
});
function setDashProgress(progress){
    $('#smartwizard').smartWizard({
        selected: progress,
        theme: 'arrows',
        autoAdjustHeight:true,
        keyNavigation:false,
        anchorSettings: {
            anchorClickable: false,
            enableAllAnchors: false
        }
    });
    $('#smartwizard2').smartWizard({
        selected: progress,
        theme: 'dots',
        autoAdjustHeight:true,
        keyNavigation:false,
        anchorSettings: {
            anchorClickable: false,
            enableAllAnchors: false
        }
    });
    $('#wizardCat').slideUp();
    
    $('#smartwizard .active').on('click', function(){
        $('#wizardCat').slideToggle();
    });
}
