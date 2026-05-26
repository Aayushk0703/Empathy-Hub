const conditionsRow1 = [
  "eating disorders", "body image issues", "relationship issues", "depression",
  "anger management", "trauma", "panic attacks", "anxiety", "stress",
];

const conditionsRow2 = [
  "procrastination", "intrusive thoughts", "irrational fear", "cognitive distortion",
  "gaslighting", "narcissism", "social anxiety", "ocd", "addiction", "burnout",
];

const MarqueeRow = ({ items, speed = "animate-marquee" }: { items: string[]; speed?: string }) => (
  <div className="overflow-hidden py-2">
    <div className={`flex gap-4 ${speed}`} style={{ width: "max-content" }}>
      {[...items, ...items, ...items].map((item, i) => (
        <span
          key={i}
          className="inline-flex items-center gap-2 px-5 py-2.5 rounded-full border border-border bg-card text-muted-foreground font-body text-sm whitespace-nowrap hover:bg-primary/10 hover:text-foreground hover:border-primary/30 transition-colors cursor-pointer"
        >
          <span className="w-2 h-2 rounded-full bg-primary/40" />
          {item}
        </span>
      ))}
    </div>
  </div>
);

const ConditionsMarquee = () => {
  return (
    <section className="py-20 px-4">
      <div className="max-w-6xl mx-auto text-center mb-10">
        <p className="text-muted-foreground font-body text-lg">However you feel now</p>
        <h2 className="font-heading text-3xl md:text-4xl text-foreground mt-1">
          We can <span className="font-bold">help</span>
        </h2>
      </div>
      <div className="max-w-full overflow-hidden">
        <MarqueeRow items={conditionsRow1} />
        <MarqueeRow items={conditionsRow2} speed="animate-marquee-slow" />
      </div>
    </section>
  );
};

export default ConditionsMarquee;
