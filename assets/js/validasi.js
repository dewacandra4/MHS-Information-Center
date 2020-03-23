
           function validasi_input(form)
           {
               if(form.Name.value == "")
               {
                    alert("Name is Empty !");
                    form.Name.focus();
                    return (false);
               }
               else if(form.Email.value == "")
               {
                    alert("Email is empty !");
                    form.Email.focus();
                    return (false);
               }
               else if(form.Total_Guest.value == "")
               {
                   alert("Total Guest is empty !");
                   form.Total_Guest.focus();
                   return (false);
               }
               else if(form.Date.value == "")
               {
                   alert("Date is empty !");
                   form.Date.focus();
                   return (false);
               }
               else if(form.Package.value == "pilih")
               {
                   alert("Please select the package !");
                   return (false);
               }
            
               return (true);
               
           }