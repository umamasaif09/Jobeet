import { AdminFormData } from "@/types/admin-form-data";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import { Button } from "../ui/button";
import BackButton from "../ui/BackButton";
import pageStyles from "@/app/styles/jobeet.module.css";
import styles from "./admins.module.css";

type Props = {
  onSubmit: () => void;
  updateField: <K extends keyof AdminFormData>(
    field: K,
    value: AdminFormData[K],
  ) => void;
  admin: AdminFormData;
};

export default function AdminForm({ onSubmit, updateField, admin }: Props) {
  function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();

    onSubmit();
  }

  return (
    <div className="flex items-baseline gap-4">
      <BackButton />
      <div className="flex-1">
        <div className="max-w-5xl space-y-6 my-[24px]">
          <h1 className={pageStyles.pageTitle}>Register Admin</h1>
          <form onSubmit={handleSubmit} className={styles.form}>
            <div className="flex flex-col gap-[8px]">
              <Label className={styles.formLabel}>
                Name <span className={styles.required}>*</span>
              </Label>
              <Input
                placeholder="Enter admin name"
                value={admin.name}
                onChange={(e) => updateField("name", e.target.value)}
                className={styles.formTextInput}
                required
              />
            </div>

            <div className="flex flex-col gap-[8px]">
              <Label className={styles.formLabel}>
                Email <span className={styles.required}>*</span>
              </Label>
              <Input
                type="email"
                placeholder="Enter admin email"
                value={admin.email}
                onChange={(e) => updateField("email", e.target.value)}
                className={styles.formTextInput}
                required
              />
            </div>

            <div className="flex flex-col gap-[8px]">
              <Label className={styles.formLabel}>
                Password <span className={styles.required}>*</span>
              </Label>
              <Input
                type="password"
                placeholder="Enter password"
                value={admin.password}
                onChange={(e) => updateField("password", e.target.value)}
                className={styles.formTextInput}
                required
              />
            </div>

            <div className="flex flex-col gap-[8px]">
              <Label className={styles.formLabel}>
                Confirm Password <span className={styles.required}>*</span>
              </Label>
              <Input
                type="password"
                placeholder="Confirm Password"
                value={admin.confirmPassword}
                onChange={(e) => updateField("confirmPassword", e.target.value)}
                className={styles.formTextInput}
                required
              />
            </div>

            <div className="flex justify-end">
              <Button type="submit" className={styles.Button}>
                Register
              </Button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}
