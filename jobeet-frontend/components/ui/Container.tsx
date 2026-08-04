type ContainerProps = {
    children: React.ReactNode;
};

export default function Container({children}: ContainerProps) {
    return (
        <div className="mx-auto max-w-[1100px] px-4">
            {children}
        </div>
    );
}