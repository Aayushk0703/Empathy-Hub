import { motion } from "framer-motion";

const partners = [
  "Fresh Prints", "Mankind", "Elektrobit", "Amity Online", "Addnode India",
  "Indian Oil", "Development Solutions", "JadeGlobal", "Airbase", "Cyara",
  "Logward", "DailyRounds", "Mpower", "Univo", "SRF"
];

const TrustedBySection = () => {
  return (
    <section className="py-20 px-4">
      <div className="max-w-6xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="text-center mb-10"
        >
          <h2 className="font-heading text-3xl md:text-4xl text-foreground">
            Trusted by those you Trust
          </h2>
          <p className="text-muted-foreground font-body mt-3 max-w-lg mx-auto">
            Our clients are our top priority, and we are committed to providing them with the highest level of service.
          </p>
        </motion.div>

        <div className="flex flex-wrap justify-center gap-6 items-center">
          {partners.map((name) => (
            <div
              key={name}
              className="px-6 py-3 bg-card rounded-xl border border-border text-muted-foreground font-body text-sm"
            >
              {name}
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default TrustedBySection;
