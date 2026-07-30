
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

  function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
      e.preventDefault();

      onSubmit();
    }


  return(
    <div className="flex items-baseline gap-4">
      <BackButton/>
      <div className="flex-1">
        <div className="max-w-5xl space-y-6">
          <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
            Register Admin
          </h1>
          <form onSubmit={handleSubmit}>
            <div className="space-y-4">
                  <div className="space-y-2">
                      <Label>Name</Label>
                      <Input
                          placeholder="Name"
                          value={admin.name}
                          onChange={(e) => updateField("name", e.target.value)}
                          required
                      />
                  </div>
                  
                  <div className="space-y-2">
                      <Label>Email</Label>
                      <Input
                          type="email"
                          placeholder="Email"
                          value={admin.email}
                          onChange={(e) => updateField("email", e.target.value)}
                          required
                      />
                  </div>

                  <div className="space-y-2">
                      <Label>Password</Label>
                      <Input
                          type = "password"
                          placeholder="Password"
                          value={admin.password}
                          onChange={(e) => updateField("password", e.target.value)}
                          required
                      />
                  </div>

                  <div className="space-y-2">
                      <Label>Confirm Password</Label>
                      <Input
                          type = "password"
                          placeholder="Confirm Password"
                          value={admin.confirmPassword}
                          onChange={(e) => updateField("confirmPassword", e.target.value)}
                          required
                      />
                  </div>

                  <div className="flex justify-end">
                    <Button
                    type="submit"
                    >
                      Register Admin
                    </Button>
                  </div>
                </div>
          </form>
                
          </div>
        </div>
  </div>
  )
}