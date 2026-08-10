import { Card, CardContent, CardHeader, CardTitle } from "../ui/card";
import styles from "./layout.module.css";
type Props = {
  title: string;
  value: number;
};

export default function StatCard({ title, value }: Props) {
  return (
    <Card className={styles.card}>
      <CardHeader>
        <CardTitle className={styles.cardH3}>{title}</CardTitle>
      </CardHeader>

      <CardContent>
        <p className={styles.cardNumber}>{value}</p>
        <p className={styles.cardLabel}>Total {title} </p>
      </CardContent>
    </Card>
  );
}
