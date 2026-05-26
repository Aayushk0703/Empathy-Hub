import { motion } from "framer-motion";

const stats = [
  { value: "20 Lakh", label: "clients helped" },
  { value: "120+", label: "countries reached" },
  { value: "85%", label: "re-optins for sessions" },
];

const StatsSection = () => {
  return (
    <section className="py-20 px-4 bg-foreground">
      <div className="max-w-6xl mx-auto">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
          {stats.map((stat, i) => (
            <motion.div
              key={i}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.15 }}
              className="text-center"
            >
              <p className="font-heading text-4xl md:text-5xl text-primary">{stat.value}</p>
              <p className="font-body text-background/70 mt-2">{stat.label}</p>
            </motion.div>
          ))}
        </div>
        <motion.p
          initial={{ opacity: 0 }}
          whileInView={{ opacity: 1 }}
          viewport={{ once: true }}
          className="text-center text-background/60 font-body max-w-2xl mx-auto leading-relaxed"
        >
          Through thousands of sessions, we've supported clients in finding clarity, resilience, and confidence in their journey toward well-being.
        </motion.p>
      </div>
    </section>
  );
};

export default StatsSection;
