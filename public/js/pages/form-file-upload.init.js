let arrImages = [];

var previewTemplate,
dropzone,
dropzonePreviewNode=document.querySelector("#dropzone-preview-list");
dropzonePreviewNode.id="",
dropzonePreviewNode&&(previewTemplate=dropzonePreviewNode.parentNode.innerHTML,
                      dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode),
                      dropzone=new Dropzone(".dropzone",{
                        url:"Vehiculos/setVehiculo",
                      
                    }))

                    dropzone.on('addedfile', file => {
                      arrImages.push(file);
                    })
                    
                    dropzone.on('removedfile', file => {
                      let i = arrImages.indexOf(file);
                      arrImages.splice(i, 1);
                    })

                    document.getElementById('btnActionForm').addEventListener('click', () => {
                      let not = [];
                      for(let i=0; i<arrImages.length; i++) {
                        let imgData = new FormData();
                        imgData.append('file', arrImages[i]);
                    
                        fetch('Vehiculos/setVehiculo', {
                          method:'POST',
                          body:imgData
                        }).then(res => res.json()).then(data => {
                          not.push(data);
                        });
                      }
                    
                      if (!not.includes('fail')) {
                        alert('Guardado');
                      } else {
                        alert('Error');
                      }
                    })
                    
                    

                  
                      
    

                      


