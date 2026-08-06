import styles from "@/app/styles/jobeet.module.css";

type ContainerProps = {
    children: React.ReactNode;
};

export default function Container({children}: ContainerProps) {
    return (
        <div className={styles.container}>
            {children}
        </div>
    );
}