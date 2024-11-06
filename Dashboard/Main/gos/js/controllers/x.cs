SqlCommand scm = new SqlCommand();
            
            
              partno = @partno, 
              description =@description,
               materialcatagory =@materialcatagory, 
               systemcatagory =@systemcatagory, 
               partfunction = @partfunction, 
               partuom =@partuom, 
               dieweight =@dieweight, 
               partsupplier =@partsupplier,
                quantityreceived =@quantityreceived, 
                quantityrejected =@quantityrejected, 
                partalloy = @partalloy, 
                partlength =@partlength, 
                partcolor =@partcolor, 
                totalweight =@totalweight, 
                 invoiceno =@invoiceno,
                  qtyflag =@qtyflag,
                   costflag =@qtyflag";
            scm.Connection = scn;
            scm.Parameters.Clear();
            scm.Parameters.AddWithValue("@unitcost", dr.Cells["avgcost"].Value.ToString());
            scm.Parameters.AddWithValue("@totalcost", dr.Cells[0].Value.ToString());
            scm.Parameters.AddWithValue("@recdate", dr.Cells[1].Value.ToString());
            scm.Parameters.AddWithValue("@recno", dr.Cells[2].Value.ToString());
            scm.Parameters.AddWithValue("@orderno", dr.Cells[3].Value.ToString());
            scm.Parameters.AddWithValue("@deliveryno", dr.Cells[4].Value.ToString());
            scm.Parameters.AddWithValue("@partno", dr.Cells[5].Value.ToString());
            scm.Parameters.AddWithValue("@description", dr.Cells[6].Value.ToString());
            scm.Parameters.AddWithValue("@materialcatagory", dr.Cells[7].Value.ToString());
            scm.Parameters.AddWithValue("@systemcatagory", dr.Cells[8].Value.ToString());
            scm.Parameters.AddWithValue("@partfunction", dr.Cells[9].Value.ToString());
            scm.Parameters.AddWithValue("@partuom", dr.Cells[10].Value.ToString());
            scm.Parameters.AddWithValue("@dieweight", dr.Cells[11].Value.ToString());
            scm.Parameters.AddWithValue("@partsupplier", dr.Cells[12].Value.ToString());
            scm.Parameters.AddWithValue("@quantityreceived", dr.Cells[13].Value.ToString());
            scm.Parameters.AddWithValue("@quantityrejected", dr.Cells[14].Value.ToString());
            scm.Parameters.AddWithValue("@partalloy", dr.Cells[15].Value.ToString());
            scm.Parameters.AddWithValue("@partlength", dr.Cells[16].Value.ToString());
            scm.Parameters.AddWithValue("@partcolor", dr.Cells[17].Value.ToString());
            scm.Parameters.AddWithValue("@totalweight", dr.Cells[18].Value.ToString());
            scm.Parameters.AddWithValue("@invoiceno", dr.Cells[21].Value.ToString());
            scm.Parameters.AddWithValue("@qtyflag", dr.Cells[22].Value.ToString());
            scm.Parameters.AddWithValue("@costflag", dr.Cells[23].Value.ToString());