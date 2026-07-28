
import { Card, CardContent } from "../ui/card";
import { AdminFormData } from "@/types/admin-form-data";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import { Button } from "../ui/button";


type Props ={
  onSubmit: ()=> void;
  updateField: <K extends keyof AdminFormData>(
    field: K, value: AdminFormData[K]
  )=> void;
  admin: AdminFormData;
}

export default function AdminForm({onSubmit, updateField, admin}: Props) {

  return(
    <Card>
      <CardContent>
        <div>
          <Label>Name</Label>
          <Input
              placeholder="Name"
              value={admin.name}
              onChange={(e) => updateField("name", e.target.value)}
          />
      </div>
      
      <div>
          <Label>Email</Label>
          <Input
              type="email"
              placeholder="Email"
              value={admin.email}
              onChange={(e) => updateField("email", e.target.value)}
          />
      </div>

      <div>
          <Label>Password</Label>
          <Input
              type = "password"
              placeholder="Password"
              value={admin.password}
              onChange={(e) => updateField("password", e.target.value)}
          />
      </div>

      <div>
          <Label>Confirm Password</Label>
          <Input
              type = "password"
              placeholder="Confirm Password"
              value={admin.confirmPassword}
              onChange={(e) => updateField("confirmPassword", e.target.value)}
          />
      </div>

      <div>
        <Button
        type="button"
        onClick={onSubmit}
        >
          Register Admin
        </Button>
      </div>

      </CardContent>
    </Card>
  )
}