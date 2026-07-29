import { updateAdmin } from "@/services/admins";
import { Admin } from "@/types/admin";
import { useEffect, useState } from "react";
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from "../ui/dialog";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import { Button } from "../ui/button";


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
      <DialogContent>
        <DialogHeader>
          <DialogTitle>
            Edit Admin
          </DialogTitle>
        </DialogHeader>

        <div className="space-y-2">
          <Label>Name</Label>

          <Input value= {name} onChange= {(e) => setName(e.target.value)}/>
        </div>

        <div className="space-y-2">
          <Label>Email</Label>

          <Input value={email} onChange = {(e) => setEmail(e.target.value)} type="email"/>
        </div>

        <DialogFooter>
          <Button variant="outline"
            onClick= {()=> onOpenChange(false)}
          >
            Cancel
          </Button>

          <Button
            onClick= {handleSubmit}
          >
            Update
          </Button>
        </DialogFooter>

      </DialogContent>

    </Dialog>
  );
}