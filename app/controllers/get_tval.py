#Given an alpha/2 value and degrees of freedom will return a t-value
import sys
from scipy.stats import t
alpha_div_2 = float(sys.argv[1])
df = float(sys.argv[2])
t = t.ppf(alpha_div_2, df)

print(t)
