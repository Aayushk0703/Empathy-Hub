const BeliefMarquee = () => {
  const text = "~ believe in the strength within ";

  return (
    <section className="py-8 bg-primary/10 overflow-hidden">
      <div className="animate-marquee flex whitespace-nowrap" style={{ width: "max-content" }}>
        {Array.from({ length: 12 }).map((_, i) => (
          <span
            key={i}
            className="font-heading text-2xl md:text-3xl text-primary/70 mx-4"
          >
            {text}
          </span>
        ))}
      </div>
    </section>
  );
};

export default BeliefMarquee;
