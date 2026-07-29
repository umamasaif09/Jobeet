
import { Card, CardContent } from "../ui/card";
import { AdminFormData } from "@/types/admin-form-data";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import { Button } from "../ui/button";
import BackButton from "../ui/BackButton";


type Props ={
  onSubmit: ()=> void;
  updateField: <K extends keyof AdminFormData>(
    field: K, value: AdminFormData[K]
  )=> void;
  admin: AdminFormData;
}

export default function AdminForm({onSubmit, updateField, admin}: Props) {

  return(
    <div className="flex items-baseline gap-4">
      <BackButton/>
      <div className="flex-1">
        <div className="max-w-5xl space-y-6">
          <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
            Register Admin
          </h1>
                <div className="space-y-4">
                  <div className="space-y-2">
                      <Label>Name</Label>
                      <Input
                          placeholder="Name"
                          value={admin.name}
                          onChange={(e) => updateField("name", e.target.value)}
                      />
                  </div>
                  
                  <div className="space-y-2">
                      <Label>Email</Label>
                      <Input
                          type="email"
                          placeholder="Email"
                          value={admin.email}
                          onChange={(e) => updateField("email", e.target.value)}
                      />
                  </div>

                  <div className="space-y-2">
                      <Label>Password</Label>
                      <Input
                          type = "password"
                          placeholder="Password"
                          value={admin.password}
                          onChange={(e) => updateField("password", e.target.value)}
                      />
                  </div>

                  <div className="space-y-2">
                      <Label>Confirm Password</Label>
                      <Input
                          type = "password"
                          placeholder="Confirm Password"
                          value={admin.confirmPassword}
                          onChange={(e) => updateField("confirmPassword", e.target.value)}
                      />
                  </div>

                  <div className="flex justify-end">
                    <Button
                    type="button"
                    onClick={onSubmit}
                    >
                      Register Admin
                    </Button>
                  </div>
                </div>
          </div>
        </div>
  </div>
  )
}