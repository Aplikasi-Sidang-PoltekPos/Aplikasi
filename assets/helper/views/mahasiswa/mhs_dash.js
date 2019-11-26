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
                if(progress_mhs==2){
                    setParameterProgress();
                }
            }else{
                $('#heading').empty();
            }
            
        }
      });
    
});

function setParameterProgress(){
    $.ajax({
        url:base_url("Mahasiswa/CekParameterBimbingan"),
        type:'get',
        contentType: false,
        processData: false,
        success: function(response){
            var res = JSON.parse(response);
            if(res.num_rows>0){
                $('#smartwizardParameter').find('ul').empty();
                var textval = '<li><a href=""><i class="fa fa-file-word"></i><br /><large>ISIKONTEN</large></a></li>';

                $.each(res.data, function(key, value){
                    $('#smartwizardParameter').find('ul').append(textval.replace('ISIKONTEN', value.judul_progress));
                });
                $('#smartwizardParameter').smartWizard({
                    selected: 1,
                    theme: 'dots',
                    autoAdjustHeight:true,
                    keyNavigation:false,
                    anchorSettings: {
                        anchorClickable: false,
                        enableAllAnchors: false
                    }
                });
            }
        }
      });
}

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
    
    $('#wizardCat').slideUp();
    
    $('#smartwizard .active').on('click', function(){
        if($(this).find('a').text()=="Progress Bimbingan"){
            $('#wizardCat').slideToggle();
        }        
    });
}
