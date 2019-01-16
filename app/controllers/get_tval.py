from scipy.stats import t
import sys

alpha = float(sys.argv[1])

df = float(sys.argv[2])

print(abs(t.ppf(alpha, df)))
