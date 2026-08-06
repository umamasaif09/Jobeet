import { updateAdmin } from "@/services/admins";
import { Admin } from "@/types/admin";
import { useEffect, useState } from "react";
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from "../ui/dialog";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import { Button } from "../ui/button";
import styles from "./admins.module.css";


type Props = {
  open: boolean;
  onOpenChange: (open: boolean)=> void;
  onSuccess: () => void;
  admin: Admin | null;
}

export default function EditAdminDialog({open, onOpenChange, onSuccess, admin}: Props) {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");


  useEffect(()=> {
    if(admin) {
      setName(admin.name);
      setEmail(admin.email);
    }
    else {
      setName("");
      setEmail("");
    }
  }, [admin]);

  async function handleSubmit() {
    const data = {admin_name: name, admin_email: email};
    
    if(!admin) return;
    await updateAdmin(admin.id.toString(), data);
    onSuccess();
    onOpenChange(false);
  }

  return(
    <Dialog open = {open} onOpenChange={onOpenChange}>
      <DialogContent className={styles.dialogContent}>
        <div className={styles.dialogHeader}>
          <div className={styles.dialogHeaderH2}>
            Edit Admin
          </div>
        </div>
        <div className={styles.dialogBody}>
            <form onSubmit={handleSubmit} id="edit-form" className={styles.dialogForm}>
              <div className={styles.formGroup}>
                <Label className={styles.formGroupLabel}>Name</Label>

                <Input value= {name} onChange= {(e) => setName(e.target.value)} 
                  className={styles.formGroupInput}
                  required/>
              </div>

              <div className={styles.formGroup}>
                  <Label className={styles.formGroupLabel}>Email</Label>

                  <Input value={email} onChange = {(e) => setEmail(e.target.value)} type="email" 
                    className={styles.formGroupInput}
                    required/>
              </div>

              <Button className={styles.dialogButton}
                type="submit" form="edit-form"
                >
                Update
              </Button>
            </form>
        </div>

      </DialogContent>

    </Dialog>
  );
}